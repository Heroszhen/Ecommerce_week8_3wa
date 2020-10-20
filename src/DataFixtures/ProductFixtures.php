<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Photo;
use Faker;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');

        // On desactive les logs pour accélerer le processus
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        
        $category1 = new Category();
        $category1->setName("fruit");
        $category1->setPhoto("10083754155f8ded5d910e67.23748912.jpg");
        $manager->persist($category1);
        $category2 = new Category();
        $category2->setName("vêtement");
        $category2->setPhoto("10083754155f8ded5d910e67.23748912.jpg");
        $manager->persist($category2);
        $manager->flush();

        $photos = glob($this->params->get('upload_dir').'product/*'); // get all file names
        foreach($photos as $one){ // iterate files
            unlink($one); // delete file
        }

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

            //10083754155f8ded5d910e67.23748912.jpg
            $number = $faker->numberBetween($min = 2, $max = 5);
            for($i = 0 ;$i < $number ;$i++){
                $photo = new Photo();
                $photo->setName("10083754155f8ded5d910e67.23748912.jpg")
                      ->setProduct($pd);
                $manager->persist($photo);
            }
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
            $number = $faker->numberBetween($min = 2, $max = 5);
            for($i = 0 ;$i < $number ;$i++){
                $photo = new Photo();
                $photo->setName("10083754155f8ded5d910e67.23748912.jpg")
                      ->setProduct($pd);
                $manager->persist($photo);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CategoryFixtures::class
        );
    }
}
