<?php

namespace App\Http\Controllers;

use App\Esewa;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function initiateUpgrade(Request $request)
    {
        $user = Auth::user();
        $amount = 2000;

        // Create an order
        $order = Order::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'payment_status' => Order::PAYMENT_PENDING,
        ]);

        // Redirect to payment gateway
        return $this->payment($order->id, $request);
    }

    public function payment($order_id, Request $request)
    {
        $order = Order::findOrFail($order_id);
        $gateway = new Esewa;

        try {
            $response = $gateway->purchase([
                'amount' => $gateway->formatAmount($order->amount),
                'totalAmount' => $gateway->formatAmount($order->amount),
                'productCode' => 'ABAC2098',
                'failedUrl' => $gateway->getFailedUrl($order),
                'returnUrl' => $gateway->getReturnUrl($order),
            ], $request);
        } catch (Exception $e) {
            $order->update(['payment_status' => Order::PAYMENT_PENDING]);

            return redirect()->route('checkout.payment.esewa.failed', [$order->id])
                ->with('message', sprintf("Your payment failed with error: %s", $e->getMessage()));
        }

        if ($response->isRedirect()) {
            $response->redirect();
        }

        return redirect()->back()->with(['message' => "Unable to process your payment. Please try again!"]);
    }

    public function completed($order_id, Request $request)
    {
        $order = Order::findOrFail($order_id);
        $gateway = new Esewa;

        $response = $gateway->verifyPayment([
            'amount' => $gateway->formatAmount($order->amount),
            'referenceNumber' => $request->get('refId'),
            'productCode' => $request->get('oid'),
        ], $request);

        if ($response->isSuccessful()) {
            $order->update([
                'transaction_id' => $request->get('refId'),
                'payment_status' => Order::PAYMENT_COMPLETED,
            ]);

            // Update user's premium status
            $user = Auth::user();
            if ($user) {
                UserDetail::updateOrCreate(
                    ['user_id' => $user->id],
                    ['is_premium' => true, 'premium_expiry_date' => now()->addYear()]
                );
            }

            return redirect()->route('user.premium')->with(['message' => 'Your payment was successful and premium membership is now active.']);
        }

        return redirect()->route('user.premium')->with(['message' => 'Payment was declined.']);
    }

    public function failed($order_id, Request $request)
    {
        $order = Order::findOrFail($order_id);
        return view('checkout.failed', compact('order'));
    }
}
