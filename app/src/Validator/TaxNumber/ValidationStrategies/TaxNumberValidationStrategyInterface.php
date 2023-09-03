<?php

namespace App\Validator\TaxNumber\ValidationStrategies;

interface TaxNumberValidationStrategyInterface
{
    public function validateTaxNumber(string $taxNumber): bool;
    public function supports(string $countryCode): bool;
}