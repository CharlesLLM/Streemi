<?php

namespace App\DataFixtures;

use App\Entity\Playlist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class PlaylistFixtures extends Fixture implements DependentFixtureInterface
{
    public const string REFERENCE_IDENTIFIER = 'playlist_';
    public const int FIXTURE_RANGE = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (range(0, self::FIXTURE_RANGE) as $i) {
            $playlist = new Playlist();
            $playlist
                ->setName($faker->unique()->word())
                ->setCreatedBy($this->getReference(UserFixtures::REFERENCE_IDENTIFIER.'superadmin'))
                ->setCreatedAt($faker->dateTimeBetween('-1 years', 'now'));

            $manager->persist($playlist);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $playlist);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
