<?php

namespace App\Services\Taxes;

class GermanyTaxCalculator implements TaxCalculatorInterface
{
    public function calculateTax(float $productPrice): float
    {
        return $productPrice * 0.19;
    }
}