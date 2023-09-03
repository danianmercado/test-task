<?php

namespace App\Services\PaymentProcessor;

use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class StripePaymentProcessorAdapter implements PaymentProcessorAdapterInterface
{
    private $stripeProcessor;

    public function __construct(StripePaymentProcessor $stripeProcessor)
    {
        $this->stripeProcessor = $stripeProcessor;
    }

    public function processPayment(int $price): bool
    {
        return $this->stripeProcessor->processPayment($price);
    }
}
