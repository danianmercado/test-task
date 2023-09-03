<?php

namespace App\Services\Discounts;

interface DiscountHandlerInterface
{
    public function applyDiscount(float $price, ?string $couponCode): float;
    public function setNext(DiscountHandlerInterface $handler): DiscountHandlerInterface;
}