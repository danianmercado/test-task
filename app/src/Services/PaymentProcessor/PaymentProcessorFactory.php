<?php

namespace App\Services\PaymentProcessor;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class PaymentProcessorFactory
{
    public function create(string $type): PaymentProcessorAdapterInterface
    {
        switch ($type) {
            case 'paypal':
                return new PaypalPaymentProcessorAdapter(new PaypalPaymentProcessor);
            case 'stripe':
                return new StripePaymentProcessorAdapter(new StripePaymentProcessor());
            default:
                throw new \InvalidArgumentException("Invalid payment processor type: $type");
        }
    }
}