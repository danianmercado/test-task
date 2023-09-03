<?php

namespace App\Form\DataValidator;

use App\Validator\Coupon\CouponExists;
use App\Validator\Product\ProductExists;
use App\Validator\TaxNumber\TaxNumberFormat;
use Symfony\Component\Validator\Constraints as Assert;

class CalculationType
{
    #[Assert\Sequentially([
        new Assert\NotBlank(message: 'Product is required'),
        new Assert\Regex(
            pattern: '/^\d+$/',
            message: 'Product must be a positive number.'
        ),
        new ProductExists,
    ])]
    public string $product;

    #[Assert\Sequentially([
        new Assert\NotBlank(message: 'TaxNumber is required'),
        new TaxNumberFormat
    ])]
    public string $taxNumber;

    #[Assert\Sequentially([
        new CouponExists,
    ])]

    public string|null $couponCode;
}
