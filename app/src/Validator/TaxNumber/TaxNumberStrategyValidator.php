<?php

namespace App\Validator\TaxNumber;

use App\Exception\UnsupportedCountryException;
use App\Validator\TaxNumber\ValidationStrategies\FranceValidationStrategy;
use App\Validator\TaxNumber\ValidationStrategies\GermanyValidationStrategy;
use App\Validator\TaxNumber\ValidationStrategies\GreeceValidationStrategy;
use App\Validator\TaxNumber\ValidationStrategies\ItalyValidationStrategy;

class TaxNumberStrategyValidator
{
    private $validationStrategies;

    public function __construct(
        FranceValidationStrategy $franceValidationStrategy,
        GermanyValidationStrategy $germanyValidationStrategy,
        GreeceValidationStrategy $greeceValidationStrategy,
        ItalyValidationStrategy $italyValidationStrategy,
    ) {
        $this->validationStrategies = [
            $franceValidationStrategy,
            $germanyValidationStrategy,
            $greeceValidationStrategy,
            $italyValidationStrategy
        ];
    }

    public function validateTaxNumber(string $taxNumber): bool
    {
        $countryCode = substr($taxNumber, 0, 2);

        foreach ($this->validationStrategies as $strategy) {
            if ($strategy->supports($countryCode)) {
                return $strategy->validateTaxNumber($taxNumber);
            }
        }

        throw new UnsupportedCountryException("The country with code $countryCode is not supported by the system.");
    }
}
