<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager) {
        $user = new User;
        $user->setName('Administrator');
        $user->setLogin('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->hasher->hashPassword($user, 'admin'));
        $manager->persist($user);
        $manager->flush();
    }
}
