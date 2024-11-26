<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const string REFERENCE_IDENTIFIER = 'episode_';
    public const int FIXTURE_RANGE = 15;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (range(0, self::FIXTURE_RANGE) as $i) {
            $episode = new Episode();
            $episode
                ->setTitle($faker->sentence())
                ->setReleaseDate($faker->dateTimeBetween('-1 year', 'now'))
                ->setDuration($faker->numberBetween(10, 60))
                ->setSeason($this->getReference(SeasonFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, SeasonFixtures::FIXTURE_RANGE)))
            ;

            ++$i;
            $manager->persist($episode);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $episode);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
