<?php

namespace App\Validator\TaxNumber\ValidationStrategies;

use App\Exception\InvalidTaxNumberFormatException;

class GermanyValidationStrategy implements TaxNumberValidationStrategyInterface
{
    public function validateTaxNumber(string $taxNumber): bool
    {
        if (!preg_match('/^DE\d{9}$/', $taxNumber)) {
            throw new InvalidTaxNumberFormatException(
                "The tax number format for Germany is incorrect. It should be DE followed by 9 digits."
            );
        }
        return true;
    }

    public function supports(string $countryCode): bool
    {
        return $countryCode === 'DE';
    }
}