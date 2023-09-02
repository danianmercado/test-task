<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $countries = [
            [
                'name' => 'Германии', 
                'regex_tax_number' => '', 
                'tax_percentage' => 19
            ],
            [
                'name' => 'Италии', 
                'regex_tax_number' => '', 
                'tax_percentage' => 22
            ],
            [
                'name' => 'Франции', 
                'regex_tax_number' => '', 
                'tax_percentage' => 20
            ],
            [
                'name' => 'Греции', 
                'regex_tax_number' => '', 
                'tax_percentage' => 24
            ],
        ];

        foreach ($countries as $country) {
            $new_country = new Country();
            $new_country->setName($country['name']);
            $new_country->setRegexTaxNumber($country['regex_tax_number']);
            $new_country->setTaxPercentage($country['tax_percentage']);
            $manager->persist($new_country);
        }

        $manager->flush();
    }
}
