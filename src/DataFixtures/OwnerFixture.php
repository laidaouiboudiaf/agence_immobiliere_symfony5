<?php

namespace App\DataFixtures;

use App\Entity\Owners;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OwnerFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $property = new Owners();
            $property
                ->setTitle($faker->words(2, true))
                ->setDiscription($faker->sentences(3, true))
                ->setSurface($faker->numberBetween(10, 320))
                ->setRooms($faker->numberBetween(10, 320))
                ->setBedrooms($faker->numberBetween(1, 10))
                ->setFloor($faker->numberBetween(0, 15))
                ->setPrice($faker->numberBetween(10000, 100000))
                ->setHeat($faker->numberBetween(0, count(Owners::HEAT), -1))
                ->setCity($faker->city)
                ->setPostalCode($faker->postcode)
                ->setAddress($faker->address)
                ->setSold(false);
            $manager->persist($property);
        }
        $manager->flush();

    }
}
