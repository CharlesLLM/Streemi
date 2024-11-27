<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class MovieFixtures extends Fixture
{
    public const string REFERENCE_IDENTIFIER = 'movie_';
    public const int FIXTURE_RANGE = 30;
    public const array DATA = [
        [
            'title' => 'Harry Potter 1',
            'shortDescription' => 'Harry Potter à l\'école des sorciers',
            'longDescription' => 'Harry Potter à l\'école des sorciers est un film fantastique britannico-américain réalisé par Chris Columbus, sorti en 2001. Il est adapté du roman du même nom de J. K. Rowling et constitue le premier volet de la série de films Harry Potter.',
            'releaseDate' => '2001-12-05',
            'coverImage' => 'https://fr.web.img6.acsta.net/c_310_420/pictures/18/07/02/17/25/3643090.jpg',
            'staff' => ['Chris Columbus'],
            'cast' => ['Daniel Radcliffe', 'Emma Watson', 'Rupert Grint'],
        ],
        [
            'title' => 'Harry Potter 2',
            'shortDescription' => 'Harry Potter et la Chambre des secrets',
            'longDescription' => 'Harry Potter et la Chambre des secrets est un film fantastique britannico-américain réalisé par Chris Columbus, sorti en 2002. Il est adapté du roman du même nom de J. K. Rowling et constitue le deuxième volet de la série de films Harry Potter.',
            'releaseDate' => '2002-12-04',
            'coverImage' => 'https://fr.web.img2.acsta.net/c_310_420/medias/nmedia/00/02/53/35/affiche0.jpg',
            'staff' => ['Chris Columbus'],
            'cast' => ['Daniel Radcliffe', 'Emma Watson', 'Rupert Grint'],
        ],
        [
            'title' => 'Harry Potter 3',
            'shortDescription' => 'Harry Potter et le Prisonnier d\'Azkaban',
            'longDescription' => 'Harry Potter et le Prisonnier d\'Azkaban est un film fantastique britannico-américain réalisé par Alfonso Cuarón, sorti en 2004. Il est adapté du roman du même nom de J. K. Rowling et constitue le troisième volet de la série de films Harry Potter.',
            'releaseDate' => '2004-06-02',
            'coverImage' => 'https://fr.web.img5.acsta.net/c_310_420/medias/nmedia/18/35/23/41/18378380.jpg',
            'staff' => ['Alfonso Cuarón'],
            'cast' => ['Daniel Radcliffe', 'Emma Watson', 'Rupert Grint'],
        ],
        [
            'title' => 'Harry Potter 4',
            'shortDescription' => 'Harry Potter et la Coupe de feu',
            'longDescription' => 'Harry Potter et la Coupe de feu est un film fantastique britannico-américain réalisé par Mike Newell, sorti en 2005. Il est adapté du roman du même nom de J. K. Rowling et constitue le quatrième volet de la série de films Harry Potter.',
            'releaseDate' => '2005-11-30',
            'coverImage' => 'https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/35/52/34/18450888.jpg',
            'staff' => ['Mike Newell'],
            'cast' => ['Daniel Radcliffe', 'Emma Watson', 'Rupert Grint'],
        ],
        [
            'title' => 'Harry Potter 5',
            'shortDescription' => 'Harry Potter et l\'Ordre du Phénix',
            'longDescription' => 'Harry Potter et l\'Ordre du Phénix est un film fantastique britannico-américain réalisé par David Yates, sorti en 2007. Il est adapté du roman du même nom de J. K. Rowling et constitue le cinquième volet de la série de films Harry Potter.',
            'releaseDate' => '2007-07-11',
            'coverImage' => 'https://fr.web.img4.acsta.net/c_310_420/medias/nmedia/18/36/32/70/18778375.jpg',
            'staff' => ['David Yates'],
            'cast' => ['Daniel Radcliffe', 'Emma Watson', 'Rupert Grint'],
        ],
        [
            'title' => 'Harry Potter 6',
            'shortDescription' => 'Harry Potter et le Prince de sang-mêlé',
            'longDescription' => 'Harry Potter et le Prince de sang-mêlé est un film fantastique britannico-américain réalisé par David Yates, sorti en 2009. Il est adapté du roman du même nom de J. K. Rowling et constitue le sixième volet de la série de films Harry Potter.',
            'releaseDate' => '2009-07-15',
            'coverImage' => 'https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/65/64/35/19116952.jpg',
            'staff' => ['David Yates'],
            'cast' => ['Daniel Radcliffe', 'Emma Watson', 'Rupert Grint'],
        ],
        [
            'title' => 'Harry Potter 7',
            'shortDescription' => 'Harry Potter et les Reliques de la Mort - Partie 1',
            'longDescription' => 'Harry Potter et les Reliques de la Mort est un film fantastique britannico-américain réalisé par David Yates, sorti en 2010. Il est adapté du roman du même nom de J. K. Rowling et constitue le septième volet de la série de films Harry Potter.',
            'releaseDate' => '2010-11-24',
            'coverImage' => 'https://fr.web.img3.acsta.net/c_310_420/medias/nmedia/18/69/69/81/19590744.jpg',
            'staff' => ['David Yates'],
            'cast' => ['Daniel Radcliffe', 'Emma Watson', 'Rupert Grint'],
        ],
        [
            'title' => 'Harry Potter 8',
            'shortDescription' => 'Harry Potter et les Reliques de la Mort - Partie 2',
            'longDescription' => 'Harry Potter et les Reliques de la Mort est un film fantastique britannico-américain réalisé par David Yates, sorti en 2011. Il est adapté du roman du même nom de J. K. Rowling et constitue le huitième volet de la série de films Harry Potter.',
            'releaseDate' => '2011-07-13',
            'coverImage' => 'https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/78/64/49/19762436.jpg',
            'staff' => ['David Yates'],
            'cast' => ['Daniel Radcliffe', 'Emma Watson', 'Rupert Grint'],
        ],
        [
            'title' => 'Les animaux fantastiques',
            'shortDescription' => 'Les Animaux fantastiques',
            'longDescription' => 'Les Animaux fantastiques est un film fantastique britannico-américain réalisé par David Yates, sorti en 2016. Il est adapté du livre Les Animaux fantastiques de J. K. Rowling et constitue le premier volet de la série de films Les Animaux fantastiques.',
            'releaseDate' => '2016-11-16',
            'coverImage' => 'https://fr.web.img6.acsta.net/c_310_420/pictures/16/10/11/09/32/205295.jpg',
            'staff' => ['David Yates'],
            'cast' => ['Eddie Redmayne', 'Katherine Waterston', 'Dan Fogler'],
        ],
        [
            'title' => 'Les animaux fantastiques 2',
            'shortDescription' => 'Les Animaux fantastiques : Les Crimes de Grindelwald',
            'longDescription' => 'Les Animaux fantastiques : Les Crimes de Grindelwald est un film fantastique britannico-américain réalisé par David Yates, sorti en 2018. Il est adapté du livre Les Animaux fantastiques de J. K. Rowling et constitue le deuxième volet de la série de films Les Animaux fantastiques.',
            'releaseDate' => '2018-11-14',
            'coverImage' => 'https://fr.web.img4.acsta.net/c_310_420/pictures/18/10/10/11/16/4794693.jpg',
            'staff' => ['David Yates'],
            'cast' => ['Eddie Redmayne', 'Katherine Waterston', 'Dan Fogler'],
        ],
        [
            'title' => 'Les animaux fantastiques 3',
            'shortDescription' => 'Les Animaux fantastiques : Les Secrets de Dumbledore',
            'longDescription' => 'Les Animaux fantastiques : Les Secrets de Dumbledore est un film fantastique britannico-américain réalisé par David Yates, sorti en 2022. Il est adapté du livre Les Animaux fantastiques de J. K. Rowling et constitue le troisième volet de la série de films Les Animaux fantastiques.',
            'releaseDate' => '2022-04-13',
            'coverImage' => 'https://fr.web.img6.acsta.net/c_310_420/pictures/22/03/16/15/20/0170262.jpg',
            'staff' => ['David Yates'],
            'cast' => ['Eddie Redmayne', 'Katherine Waterston', 'Dan Fogler'],
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (range(0, self::FIXTURE_RANGE) as $key) {
            $movie = new Movie();

            if (isset(self::DATA[$key])) {
                $data = self::DATA[$key];
                $movie
                    ->setTitle($data['title'])
                    ->setShortDescription($data['shortDescription'])
                    ->setLongDescription($data['longDescription'])
                    ->setReleaseDate(new \DateTime($data['releaseDate']))
                    ->setCoverImage($data['coverImage'])
                    ->setStaff($data['staff'])
                    ->setCast($data['cast'])
                ;
            } else {
                $movie
                    ->setTitle($faker->sentence(3))
                    ->setShortDescription($faker->realText(100))
                    ->setLongDescription($faker->realText(500))
                    ->setReleaseDate($faker->dateTimeBetween('-50 year', 'now'))
                    ->setCoverImage('https://picsum.photos/310/420')
                    ->setStaff([$faker->name, $faker->name, $faker->name])
                    ->setCast([$faker->name, $faker->name, $faker->name])
                ;
            }

            ++$key;
            $manager->persist($movie);
            $this->setReference(self::REFERENCE_IDENTIFIER.$key, $movie);
        }

        $manager->flush();
    }
}
