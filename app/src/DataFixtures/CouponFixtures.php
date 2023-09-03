<?php

namespace App\DataFixtures;

use App\Entity\Coupon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CouponFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $coupons = [
            [
                'code' => 'D15654',
                'type' => 'discount',
                'value' => 50,
                'is_active' => 1
            ],
            [
                'code' => 'D15656',
                'type' => 'discount',
                'value' => 5,
                'is_active' => 1
            ],
            [
                'code' => 'D15655',
                'type' => 'discount',
                'value' => 20,
                'is_active' => 0
            ],
            [
                'code' => 'P15657',
                'type' => 'percentage',
                'value' => 14,
                'is_active' => 1
            ],
            [
                'code' => 'P15658',
                'type' => 'percentage',
                'value' => 9,
                'is_active' => 0
            ],
        ];

        foreach ($coupons as $coupon) {
            $new_coupon = new Coupon();
            $new_coupon->setCode($coupon['code']);
            $new_coupon->setType($coupon['type']);
            $new_coupon->setValue($coupon['value']);
            $new_coupon->setIsActive($coupon['is_active']);
            $manager->persist($new_coupon);
        }

        $manager->flush();
    }
}
