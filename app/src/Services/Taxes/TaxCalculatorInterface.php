<?php

namespace App\Services\Taxes;

interface TaxCalculatorInterface
{
    public function calculateTax(float $productPrice): float;
}