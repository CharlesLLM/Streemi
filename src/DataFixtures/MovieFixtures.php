<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class MovieFixtures extends Fixture
{
    public const string REFERENCE_IDENTIFIER = 'movie_';
    public const int FIXTURE_RANGE = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (range(0, self::FIXTURE_RANGE) as $i) {
            $movie = new Movie();
            $movie
                ->setTitle($faker->sentence())
                ->setShortDescription($faker->text(100))
                ->setLongDescription($faker->text(500))
                ->setSubscribedAt($faker->dateTimeBetween('-1 year', 'now'))
                ->setCoverImage($faker->imageUrl(1280, 720))
                ->setStaff([$faker->name, $faker->name, $faker->name])
                ->setCast([$faker->name, $faker->name, $faker->name])
            ;

            ++$i;
            $manager->persist($movie);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $movie);
        }

        $manager->flush();
    }
}
