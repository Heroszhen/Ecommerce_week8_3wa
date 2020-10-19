<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

         // On desactive les logs pour accélerer le processus
         $manager->getConnection()->getConfiguration()->setSQLLogger(null);

         $categories = ["légume","scooter","arme","meuble"];
         foreach($categories as $one){
            $category = new Category();
            $category->setName($one);
            $manager->persist($category);
         }

        $manager->flush();
    }
}
