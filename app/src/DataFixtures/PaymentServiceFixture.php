<?php

namespace App\DataFixtures;

use App\Entity\PaymentService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PaymentServiceFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $services = [
            ['name' => 'paypal'],
            ['name' => 'stripe'],
        ];

        foreach ($services as $service) {
            $new_service = new PaymentService();
            $new_service->setName($service['name']);
            $manager->persist($new_service);
        }

        $manager->flush();
    }
}
