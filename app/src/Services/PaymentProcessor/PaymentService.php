<?php

namespace App\Services\PaymentProcessor;

class PaymentService
{
    private $processorFactory;

    public function __construct(PaymentProcessorFactory $processorFactory)
    {
        $this->processorFactory = $processorFactory;
    }

    public function processPayment(string $processorType, int $price): bool
    {
        try {
            if ($price >= 0) {
                $processorAdapter = $this->processorFactory->create($processorType);
                return $processorAdapter->processPayment($price);
            } else {
                throw new \InvalidArgumentException("Pay value cant be negative");
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
