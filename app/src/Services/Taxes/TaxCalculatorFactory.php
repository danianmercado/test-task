<?php

namespace App\Services\Taxes;

class TaxCalculatorFactory
{
    public function createCalculator(string $taxNumber): TaxCalculatorInterface
    {
        $countryCode = substr($taxNumber, 0, 2);

        switch ($countryCode) {
            case 'DE':
                return new GermanyTaxCalculator();
            case 'IT':
                return new ItalyTaxCalculator();
            case 'FR':
                return new FranceTaxCalculator();
            case 'GR':
                return new GreeceTaxCalculator();
            default:
                throw new \InvalidArgumentException('Invalid country code: ' . $countryCode);
        }
    }
}