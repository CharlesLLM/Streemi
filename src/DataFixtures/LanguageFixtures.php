<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class LanguageFixtures extends Fixture
{
    public const string REFERENCE_IDENTIFIER = 'language_';
    public const int FIXTURE_RANGE = 10;
    public const array DATA = [
        'fr' => 'Français',
        'en' => 'Anglais',
        'es' => 'Espagnol',
        'de' => 'Allemand',
        'it' => 'Italien',
        'pt' => 'Portugais',
        'nl' => 'Néerlandais',
        'ru' => 'Russe',
        'zh' => 'Chinois',
        'ja' => 'Japonais',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (self::DATA as $code => $name) {
            $language = new Language();
            $language
                ->setName($name)
                ->setCode($code)
            ;

            $manager->persist($language);
            $this->setReference(self::REFERENCE_IDENTIFIER.$code, $language);
        }

        $manager->flush();
    }
}
