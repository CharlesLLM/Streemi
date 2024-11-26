<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const string REFERENCE_IDENTIFIER = 'user_';
    public const int FIXTURE_RANGE = 5;

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $user = new User();
        $user->setUsername('superadmin')
            ->setEmail('test@test.fr')
            ->setPassword($this->passwordHasher->hashPassword($user, 'superadmin'))
            ->setRoles(['ROLE_ADMIN'])
            ->setCurrentSubscription($this->getReference(SubscriptionFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, SubscriptionFixtures::FIXTURE_RANGE)))
        ;

        $manager->persist($user);
        $this->setReference(self::REFERENCE_IDENTIFIER.'superadmin', $user);

        foreach (range(0, self::FIXTURE_RANGE) as $i) {
            $mainRole = 1 === $i ? 'admin' : 'user';

            $user = new User();
            $user
                ->setUsername($faker->unique(1 === $i)->userName())
                ->setEmail($faker->unique(1 === $i)->email())
                ->setPassword($this->passwordHasher->hashPassword(
                    $user,
                    'admin' === $mainRole ? 'admin' : 'user'
                ))
                ->setRoles(['ROLE_USER'])
                ->setCurrentSubscription($this->getReference(SubscriptionFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, SubscriptionFixtures::FIXTURE_RANGE)))
            ;

            if ('admin' === $mainRole) {
                $user->addRole('ROLE_ADMIN');
            }

            ++$i;
            $manager->persist($user);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $user);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SubscriptionFixtures::class,
        ];
    }
}
