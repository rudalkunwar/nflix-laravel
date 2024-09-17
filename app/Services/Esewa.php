<?php

namespace App\Services;

use Omnipay\Omnipay;

class Esewa
{
    protected $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('Esewa_Secure');
        $this->gateway->setMerchantCode(config('services.esewa.merchant'));
        $this->gateway->setTestMode(config('services.esewa.sandbox'));
    }

    public function purchase(array $parameters)
    {
        return $this->gateway->purchase($parameters)->send();
    }

    public function verifyPayment(array $parameters)
    {
        return $this->gateway->verifyPayment($parameters)->send();
    }

    public function formatAmount($amount)
    {
        return number_format($amount, 2, '.', '');
    }

    public function getFailedUrl($order)
    {
        return route('checkout.payment.esewa.failed', $order->id);
    }

    public function getReturnUrl($order)
    {
        return route('checkout.payment.esewa.completed', $order->id);
    }
}
