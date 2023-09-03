<?php

namespace App\Validator\TaxNumber\ValidationStrategies;

use App\Exception\InvalidTaxNumberFormatException;

class FranceValidationStrategy implements TaxNumberValidationStrategyInterface
{
    public function validateTaxNumber(string $taxNumber): bool
    {
        if (!preg_match('/^FR[A-Za-z]{2}\d{9}$/', $taxNumber)) {
            throw new InvalidTaxNumberFormatException(
                "The tax number format for France is incorrect. It should be FR followed by 2 letters and 9 digits."
            );
        }
        return true;
    }

    public function supports(string $countryCode): bool
    {
        return $countryCode === 'FR';
    }
}