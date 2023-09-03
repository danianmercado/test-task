<?php

namespace App\Validator\TaxNumber;

use App\Exception\InvalidTaxNumberFormatException;
use App\Exception\UnsupportedCountryException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TaxNumberFormatValidator extends ConstraintValidator
{

    public function __construct(private TaxNumberStrategyValidator $taxesHandler)
    {
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof TaxNumberFormat) {
            throw new UnexpectedTypeException($constraint, TaxNumberFormat::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        try {
            if (!$this->taxesHandler->validateTaxNumber($value)){
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $value)
                    ->addViolation();
            }
        } catch (UnsupportedCountryException $exception) {
            $this->context->buildViolation($exception->getMessage())
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        } catch (InvalidTaxNumberFormatException $exception) {
            $this->context->buildViolation($exception->getMessage())
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}