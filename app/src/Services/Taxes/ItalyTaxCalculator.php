<?php

namespace App\Services\Taxes;

class ItalyTaxCalculator implements TaxCalculatorInterface
{
    public function calculateTax(float $productPrice): float
    {
        return $productPrice * 0.22;
    }
}