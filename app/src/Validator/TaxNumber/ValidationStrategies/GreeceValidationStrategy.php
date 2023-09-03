<?php

namespace App\Validator\TaxNumber\ValidationStrategies;

use App\Exception\InvalidTaxNumberFormatException;

class GreeceValidationStrategy implements TaxNumberValidationStrategyInterface
{
    public function validateTaxNumber(string $taxNumber): bool
    {
        if (!preg_match('/^GR\d{9}$/', $taxNumber)) {
            throw new InvalidTaxNumberFormatException(
                "The tax number format for Greece is incorrect. It should be GR followed by 9 digits."
            );
        }
        return true;
    }

    public function supports(string $countryCode): bool
    {
        return $countryCode === 'GR';
    }
}