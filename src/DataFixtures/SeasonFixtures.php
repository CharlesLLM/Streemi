<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const string REFERENCE_IDENTIFIER = 'season_';
    public const int FIXTURE_RANGE = 15;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (range(0, self::FIXTURE_RANGE) as $i) {
            $season = new Season();
            $season
                ->setNumber($faker->numberBetween(1, 10))
                ->setSerie($this->getReference(SerieFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, SerieFixtures::FIXTURE_RANGE)))
            ;

            ++$i;
            $manager->persist($season);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $season);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SerieFixtures::class,
        ];
    }
}
