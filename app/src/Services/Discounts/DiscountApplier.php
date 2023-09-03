<?php

namespace App\Services\Discounts;

use App\Entity\Coupon;
use Doctrine\ORM\EntityManagerInterface;

class DiscountApplier
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function applyDiscount(float $price, ?string $couponCode): float
    {
        $discountInfo = $this->entityManager->getRepository(Coupon::class)->findOneBy(['code' => $couponCode]);
        if ($discountInfo) {
            $discountHandler = $this->getHandlerForDiscount($discountInfo);
            return $discountHandler->applyDiscount($price, $couponCode);
        }

        return $price;
    }

    private function getHandlerForDiscount(Coupon $discountInfo): DiscountHandlerInterface
    {
        if ($discountInfo->getType() == 'fixed') {
            return new FixedDiscountHandler($this->entityManager);
        } elseif ($discountInfo->getType() == 'percentage') {
            return new PercentageDiscountHandler($this->entityManager);
        }
    }
}
