<?php

namespace App\Services\PaymentProcessor;

interface PaymentProcessorAdapterInterface
{
    public function processPayment(int $price): bool;
}