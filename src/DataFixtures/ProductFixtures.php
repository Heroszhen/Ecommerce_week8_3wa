<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Product;
use Faker;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');

        // On desactive les logs pour accélerer le processus
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        
        $category1 = new Category();
        $category1->setName("fruit");
        $manager->persist($category1);
        $category2 = new Category();
        $category2->setName("vêtement");
        $manager->persist($category2);
        $manager->flush();

        $fruits  = ["pomme","orange","pasteque","cerise","pamplemousse"];
        foreach($fruits as $one){
            $pd = new Product();
            $pd->setName($one)
               ->setPrice($faker->numberBetween($min = 100, $max = 900))
               ->setDescription($faker->text($maxNbChars = 200))
               ->setStock($faker->numberBetween($min = 0, $max = 9000)) 
               ->setOrigin($faker->country)
               ->setCategory($category1)
               ->setCreated(new \DateTime());
            $manager->persist($pd);
        }

        $clothes = ["t-short","jean","chapeau","manteau","gants"];
        foreach($clothes as $one){
            $pd = new Product();
            $pd->setName($one)
               ->setPrice($faker->numberBetween($min = 10, $max = 200))
               ->setDescription($faker->text($maxNbChars = 200))
               ->setStock($faker->numberBetween($min = 0, $max = 200)) 
               ->setOrigin($faker->country)
               ->setCategory($category2)
               ->setCreated(new \DateTime());
            $manager->persist($pd);
        }


        $manager->flush();
    }
}
