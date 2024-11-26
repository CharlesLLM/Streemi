<?php

namespace App\DataFixtures;

use App\Entity\PlaylistMedia;
use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class PlaylistMediaFixtures extends Fixture implements DependentFixtureInterface
{
    public const string REFERENCE_IDENTIFIER = 'playlist_media_';
    public const int FIXTURE_RANGE = 20;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (range(0, self::FIXTURE_RANGE) as $i) {
            $playlistMedia = new PlaylistMedia();
            $playlistMedia
                ->setPlaylist($this->getReference(PlaylistFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, PlaylistFixtures::FIXTURE_RANGE)))
                ->setMedia($this->getReference(MovieFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, MovieFixtures::FIXTURE_RANGE)))
                ->setAddedAt($faker->dateTimeBetween('-1 year', 'now'))
            ;

            ++$i;
            $manager->persist($playlistMedia);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $playlistMedia);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PlaylistFixtures::class,
            MovieFixtures::class,
            SerieFixtures::class,
        ];
    }
}
