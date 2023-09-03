<?php

namespace App\Validator\Coupon;

use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class CouponExists extends Constraint
{
    public string $message = "The coupon with code '{{ value }}' was not found.";

    #[HasNamedArguments]
    public function __construct(array $groups = null, mixed $payload = null)
    {
        parent::__construct([], $groups, $payload);
    }
}
