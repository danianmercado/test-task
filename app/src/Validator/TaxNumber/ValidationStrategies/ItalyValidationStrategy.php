<?php

namespace App\Validator\TaxNumber\ValidationStrategies;

use App\Exception\InvalidTaxNumberFormatException;

class ItalyValidationStrategy implements TaxNumberValidationStrategyInterface
{
    public function validateTaxNumber(string $taxNumber): bool
    {
        if (!preg_match('/^IT\d{11}$/', $taxNumber)) {
            throw new InvalidTaxNumberFormatException(
                "The tax number format for Italy is incorrect. It should be IT followed by 11 digits."
            );
        }
        return true;
    }

    public function supports(string $countryCode): bool
    {
        return $countryCode === 'IT';
    }
}