<?php

namespace App\DataFixtures;

use App\Entity\PlaylistSubscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class PlaylistSubscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public const string REFERENCE_IDENTIFIER = 'playlist_subscription_';
    public const int FIXTURE_RANGE = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (range(0, self::FIXTURE_RANGE) as $i) {
            $history = new PlaylistSubscription();
            $history
                ->setSubscriber($this->getReference(UserFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, UserFixtures::FIXTURE_RANGE)))
                ->setPlaylist($this->getReference(PlaylistFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, PlaylistFixtures::FIXTURE_RANGE)))
                ->setSubscribedAt($faker->dateTimeBetween('-1 year', '-1 month'))
            ;

            $manager->persist($history);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $history);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PlaylistFixtures::class,
            UserFixtures::class,
        ];
    }
}
