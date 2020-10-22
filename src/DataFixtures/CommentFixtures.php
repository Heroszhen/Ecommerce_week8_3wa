<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Comment;
use Faker;
use Faker\Factory;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');

        // On desactive les logs pour accélerer le processus
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);

        $user = $manager->find(User::class,1);
        $product = $manager->find(Product::class,1);
        for($i = 0; $i <= 10 ;$i++){
            $co = new Comment();
            $co
                ->setUser($user)
                ->setProduct($product)
                ->setMessage($faker->text($maxNbChars = 200))
                ->setCreated(new \DateTime());
            $manager->persist($co);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            ProductFixtures::class,
        );
    }
}
