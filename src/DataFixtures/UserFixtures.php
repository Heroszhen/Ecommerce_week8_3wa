<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;
use Faker\Factory;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        // On desactive les logs pour accélerer le processus
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        
        //create admin
        $user = new User();
        $user  
            ->setLastname('Héros')
            ->setFirstname('zhen')
            ->setEmail('zhen@gmail.com')
            ->setPassword($this->encoder->encodePassword($user,'aaaaaaaa'))
            ->setRoles(["ROLE_USER","ROLE_ADMIN"])
            ->setCreated(new \DateTime());
        $manager->persist($user);
        $manager->flush();

        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setEmail($faker->email)
                ->setPassword($this->encoder->encodePassword($user, "aaaaaaaa"))
                ->setRoles(["ROLE_USER"])
                ->setCreated(new \DateTime());
            $manager->persist($user); 
        }
        $manager->flush();
    }
}
