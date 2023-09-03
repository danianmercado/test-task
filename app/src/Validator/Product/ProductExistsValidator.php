<?php

namespace App\Validator\Product;

use App\Repository\ProductRepository;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ProductExistsValidator extends ConstraintValidator
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ProductExists) {
            throw new UnexpectedTypeException($constraint, ProductExists::class);
        }

        if (null === $value || '' === $value) {
            return;
        }
        
        $entity = $this->productRepository->find($value);

        if (!$entity) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}