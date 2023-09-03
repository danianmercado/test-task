<?php

namespace App\Validator\Coupon;

use App\Repository\CouponRepository;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CouponActiveValidator extends ConstraintValidator
{
    public function __construct(private CouponRepository $couponRepository)
    {
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var CouponCodeExists $constraint */
        if (!$constraint instanceof CouponActive) {
            throw new UnexpectedTypeException($constraint, CouponActive::class);
        }

        if (null === $value || '' === $value) {
            return;
        }
        
        $entity = $this->couponRepository->findOneBy([
            'code' => $value
        ]);

        if (!$entity->isIsActive()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}