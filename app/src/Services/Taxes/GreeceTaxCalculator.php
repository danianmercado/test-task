<?php

namespace App\Services\Taxes;

class GreeceTaxCalculator implements TaxCalculatorInterface
{
    public function calculateTax(float $productPrice): float
    {
        return $productPrice * 0.24;
    }
}