<?php

namespace App\DataFixtures;

use App\Entity\SubscriptionHistory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class SubscriptionHistoryFixtures extends Fixture implements DependentFixtureInterface
{
    public const string REFERENCE_IDENTIFIER = 'subscription_history_';
    public const int FIXTURE_RANGE = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (range(0, self::FIXTURE_RANGE) as $i) {
            $history = new SubscriptionHistory();
            $history
                ->setSubscriber($this->getReference(UserFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, UserFixtures::FIXTURE_RANGE)))
                ->setSubscription($this->getReference(SubscriptionFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, SubscriptionFixtures::FIXTURE_RANGE)))
                ->setStartDate($faker->dateTimeBetween('-1 year', '-1 month'))
                ->setEndDate($faker->dateTimeBetween('+1 month', '+1 year'))
            ;

            ++$i;
            $manager->persist($history);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $history);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SubscriptionFixtures::class,
            UserFixtures::class,
        ];
    }
}
