<?php

namespace App\Http\Controllers;

use Nujan\Esewa\esewa;
use App\Models\Order;
use App\Models\UserDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function initiateUpgrade(Request $request)
    {
        $user = Auth::user();

        $amount = 2000; // Fixed amount for upgrade

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

            $data = [
                'amount' => $this->formatAmount($order->amount),
                'total_amount' => $this->formatAmount($order->amount),
                'tax_amount' => 0,
                'transaction_uuid' => uniqid(mt_rand(), true),
                'product_code' => 'EPAYTEST',
                'product_service_charge' => 0,
                'product_delivery_charge' => 0,
                'failure_url' => route('checkout.payment.esewa.failed', $order->id),
                'success_url' => route('checkout.payment.esewa.completed', $order->id),
                'signed_field_names' => 'total_amount,transaction_uuid,product_code',
            ];

            $response = $gateway->sendPaymentRequest($data);

            return $response;

        } catch (Exception $e) {
            // Update payment status to pending in case of error
            $order->update(['payment_status' => Order::PAYMENT_PENDING]);

            return redirect()->route('checkout.payment.esewa.failed', [$order->id])
                ->with('message', sprintf("Your payment failed with error: %s", $e->getMessage()));
        }
    }

    public function completed($order_id, Request $request)
    {
        $order = Order::findOrFail($order_id);

        $encodedData = $request->get('data');

        $decodeData = json_decode(base64_decode($encodedData), true);

        try {
            if (is_array($decodeData) && isset($decodeData['product_code'], $decodeData['total_amount'], $decodeData['transaction_uuid'])) {
               
                $order->update([
                    'transaction_id' => $request->get('refId'),
                    'payment_status' => Order::PAYMENT_COMPLETED,
                ]);

                $user = Auth::user();

                if ($user) {
                    UserDetails::updateOrCreate(
                        ['user_id' => $user->id],
                        ['is_premium' => true, 'premium_expiry_date' => now()->addYear()]
                    );
                }

                return redirect()->route('user.premium')
                    ->with(['message' => 'Your payment was successful and premium membership is now active.']);
            }

        } catch (Exception $e) {
            return redirect()->route('checkout.payment.esewa.failed', [$order->id])
                ->with('message', 'Payment verification failed: ' . $e->getMessage());
        }

        return redirect()->route('user.premium')
            ->with(['message' => 'Payment was declined.']);
    }

    public function failed($order_id, Request $request)
    {
        $order = Order::findOrFail($order_id);
        
        return view('users.failed-payment', compact('order'));
    }

    public function formatAmount($amount)
    {
        // Return an integer by removing commas and decimals
        return (int) str_replace([',', '.'], '', $amount);
    }
}
