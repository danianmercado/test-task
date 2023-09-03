<?php

namespace App\Validator\Coupon;

use App\Repository\CouponRepository;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CouponExistsValidator extends ConstraintValidator
{
    public function __construct(private CouponRepository $couponRepository)
    {
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var CouponCodeExists $constraint */
        if (!$constraint instanceof CouponExists) {
            throw new UnexpectedTypeException($constraint, CouponExists::class);
        }

        if (null === $value || '' === $value) {
            return;
        }
        
        $entity = $this->couponRepository->findOneBy([
            'code' => $value
        ]);

        if (!$entity) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}