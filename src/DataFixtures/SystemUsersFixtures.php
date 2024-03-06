<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SystemUsersFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@younglink.cz');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'Dvp6EB76FEYlWJgw'));
        $user->setRoles(['ROLE_SONATA_ADMIN']);
        $user->setEnabled(true);
        $manager->persist($user);

        $user2 = new User();
        $user2->setUsername('api');
        $user2->setEmail('api@younglink.cz');
        $user2->setPassword($this->passwordHasher->hashPassword($user, 'srSw4ZLSCbCq4DgZ'));
        $user2->setRoles(['ROLE_API_USER']);
        $user2->setEnabled(true);
        $manager->persist($user2);

        $manager->flush();
    }
}
