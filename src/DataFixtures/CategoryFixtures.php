<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class CategoryFixtures extends Fixture
{
    public const string REFERENCE_IDENTIFIER = 'category_';
    public const int FIXTURE_RANGE = 4;
    public const array DATA = [
        'action' => [
            'name' => 'Action',
            'label' => 'Action',
        ],
        'adventure' => [
            'name' => 'Aventure',
            'label' => 'Aventure',
        ],
        'comedy' => [
            'name' => 'Comédie',
            'label' => 'Comédie',
        ],
        'sci-fi' => [
            'name' => 'Science Fiction',
            'label' => 'Science Fiction',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATA as $key => $data) {
            $category = new Category();
            $category
                ->setName($data['name'])
                ->setSlug($key)
                ->setLabel($data['label'])
            ;

            $manager->persist($category);
            $this->setReference(self::REFERENCE_IDENTIFIER.$key, $category);
        }

        $manager->flush();
    }
}
