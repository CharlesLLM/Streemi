<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

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
        $slugger = new AsciiSlugger();

        foreach (self::DATA as $i => $data) {
            $category = new Category();
            $category
                ->setName($data['name'])
                ->setSlug($slugger->slug($data['name']))
                ->setLabel($data['label'])
            ;

            $manager->persist($category);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $category);
        }

        $manager->flush();
    }
}
