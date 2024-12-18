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
    public const int FIXTURE_RANGE = 6;

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $user = new User();
        $user->setUsername('superadmin')
            ->setEmail('superadmin@esgi.fr')
            ->setPassword($this->passwordHasher->hashPassword($user, 'superadmin'))
            ->setRoles(['ROLE_SUPER_ADMIN'])
            ->setCurrentSubscription($this->getReference(SubscriptionFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, SubscriptionFixtures::FIXTURE_RANGE)))
        ;

        $manager->persist($user);
        $this->setReference(self::REFERENCE_IDENTIFIER.'superadmin', $user);

        foreach (range(0, self::FIXTURE_RANGE - 1) as $i) {
            $isAdmin = 0 === $i;
            $username = $isAdmin ? 'admin' : "user{$i}";

            $user = new User();
            $user
                ->setUsername($isAdmin ? 'admin' : "user{$i}")
                ->setEmail("{$username}@esgi.fr")
                ->setPassword($this->passwordHasher->hashPassword(
                    $user,
                    $isAdmin ? 'admin' : 'user' // admin password is 'admin', user password is 'user'
                ))
                ->setRoles($isAdmin ? ['ROLE_ADMIN'] : ['ROLE_USER'])
                ->setCurrentSubscription($this->getReference(SubscriptionFixtures::REFERENCE_IDENTIFIER.$faker->numberBetween(1, SubscriptionFixtures::FIXTURE_RANGE)))
            ;

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
