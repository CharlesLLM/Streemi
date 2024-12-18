<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class MovieFixtures extends Fixture
{
    public const string REFERENCE_IDENTIFIER = 'movie_';
    public const int FIXTURE_RANGE = 25;

    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__.'/Data/movies.json'), true);
        $faker = Factory::create('fr_FR');
        $categoryKeys = array_keys(CategoryFixtures::DATA);

        foreach (range(0, self::FIXTURE_RANGE - 1) as $key) {
            $movie = new Movie();

            if (isset($data[$key])) {
                $value = $data[$key];
                $movie
                    ->setTitle($value['title'])
                    ->setShortDescription($value['shortDescription'])
                    ->setLongDescription($value['longDescription'])
                    ->setReleaseDate(new \DateTime($value['releaseDate']))
                    ->setCoverImage($value['coverImage'])
                    ->setScore($value['score'])
                    ->setStaff($value['staff'])
                    ->setCast($value['cast'])
                    ->addCategory($this->getReference(CategoryFixtures::REFERENCE_IDENTIFIER.'adventure'))
                ;
            } else {
                $movie
                    ->setTitle($faker->realText(20))
                    ->setShortDescription($faker->realText(100))
                    ->setLongDescription($faker->realText(500))
                    ->setReleaseDate($faker->dateTimeBetween('-50 year', 'now'))
                    ->setCoverImage('https://picsum.photos/310/420')
                    ->setScore($faker->numberBetween(0, 5))
                    ->setStaff([$faker->name, $faker->name, $faker->name])
                    ->setCast([$faker->name, $faker->name, $faker->name])
                    ->addCategory($this->getReference(CategoryFixtures::REFERENCE_IDENTIFIER.$faker->randomElement($categoryKeys)))
                ;
            }

            ++$key;
            $manager->persist($movie);
            $this->setReference(self::REFERENCE_IDENTIFIER.$key, $movie);
        }

        $manager->flush();
    }
}
