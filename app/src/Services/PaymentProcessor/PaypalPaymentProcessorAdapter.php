<?php

namespace App\Services\PaymentProcessor;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class PaypalPaymentProcessorAdapter implements PaymentProcessorAdapterInterface
{
    private $paypalProcessor;

    public function __construct(PaypalPaymentProcessor $paypalProcessor)
    {
        $this->paypalProcessor = $paypalProcessor;
    }

    public function processPayment(int $price): bool
    {
        try {
            $this->paypalProcessor->pay($price);
            return true;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
