<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Command;
use Faker;
use Faker\Factory;

class CommandFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');

        // On desactive les logs pour accélerer le processus
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);

        $user = $manager->find(User::class,1);
        for($i = 0; $i <= 5 ;$i++){
            $n = $faker->numberBetween($min = 1, $max = 14);
            $product = $manager->find(Product::class,$n);
            $command = new Command();
            $command
                ->setUser($user)
                ->setProduct($product)
                ->setQuantity($n)
                ->setPrice($product->getPrice())
                ->setCreated(new \DateTime());
            $manager->persist($command);
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
