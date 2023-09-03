<?php

namespace App\Validator\Product;

use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class ProductExists extends Constraint
{
    public string $message = "The product with id '{{ value }}' was not found.";

    #[HasNamedArguments]
    public function __construct(array $groups = null, mixed $payload = null)
    {
        parent::__construct([], $groups, $payload);
    }
}
