<?php

namespace App\Services\Discounts;

use App\Entity\Coupon;
use Doctrine\ORM\EntityManagerInterface;

class PercentageDiscountHandler implements DiscountHandlerInterface
{
    private $nextHandler;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function applyDiscount(float $price, ?string $couponCode): float
    {
        $discount = $this->entityManager->getRepository(Coupon::class)->findOneBy(['code' => $couponCode]);

        if ($discount && $discount->getType() === 'percentage') {
            return $price * (1 - ($discount->getValue() / 100));
        } elseif ($this->nextHandler !== null) {
            return $this->nextHandler->applyDiscount($price, $couponCode);
        }

        return $price;
    }

    public function setNext(DiscountHandlerInterface $handler): DiscountHandlerInterface
    {
        $this->nextHandler = $handler;

        return $handler;
    }
}