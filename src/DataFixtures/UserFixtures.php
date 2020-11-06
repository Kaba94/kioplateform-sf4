<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    /**
     * Dans une classe (autre qu'un controlleur), on peut récupérer des services
     * par autowiring uniquement dans le constructeur
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 5; $i++){
            $admin = new User();
            $password = $this->encoder->encodePassword($admin, 'admin' . $i);

            return $admin
                ->setEmail('admin' . $i . '@digitlabs.fr')
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword($password)
                ->setUsername('admin_' . $i)
            ;
            $manager->persist($admin);
        };

        for($j = 1; $j <= 10; $j++){
            $user = new User();
            $password = $this->encoder->encodePassword($user, 'user' . $j);

            return $user
                ->setEmail('user' . $j . '@digitlabs.fr')
                ->setPassword($password)
                ->setUsername('user_' . $j)
            ;
            $manager->persist($user);
        }

        $manager->flush();
    }
}
