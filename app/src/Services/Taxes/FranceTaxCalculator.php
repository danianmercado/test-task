<?php

namespace App\Services\Taxes;

class FranceTaxCalculator implements TaxCalculatorInterface
{
    public function calculateTax(float $productPrice): float
    {
        return $productPrice * 0.20;
    }
}