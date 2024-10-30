<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class CategoryFixtures extends Fixture
{
    public const string REFERENCE_IDENTIFIER = 'category_';
    public const int FIXTURE_RANGE = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (range(0, self::FIXTURE_RANGE) as $i) {
            $category = new Category();
            $category
                ->setName($faker->unique()->sentence())
                ->setLabel($faker->unique()->sentence())
            ;

            $manager->persist($category);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $category);
        }

        $manager->flush();
    }
}
