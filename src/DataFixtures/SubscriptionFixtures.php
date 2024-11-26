<?php

namespace App\DataFixtures;

use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class SubscriptionFixtures extends Fixture
{
    public const string REFERENCE_IDENTIFIER = 'subscription_';
    public const int FIXTURE_RANGE = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (range(0, self::FIXTURE_RANGE) as $i) {
            $subscription = new Subscription();
            $subscription
                ->setName($faker->unique()->word())
                ->setPrice($faker->numberBetween(1, 100))
                ->setDuration($faker->numberBetween(1, 12))
            ;

            ++$i;
            $manager->persist($subscription);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $subscription);
        }

        $manager->flush();
    }
}
