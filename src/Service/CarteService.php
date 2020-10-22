<?php
namespace App\Service;

use App\Entity\User;
use App\Entity\Carte;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CarteService{
   private $em;

   public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function addBdd(User $user,$session){
        $carte = $session->get("carte",[]);
        foreach($carte as $id=>$quantity){
            $product = $this->em->find(Product::class,$id);
            $cartebdd = $this->em->getRepository(Carte::class)->findOneBy(["user"=>$user,"product"=>$product,"status"=>0]);
            if(empty((array)$cartebdd)){
                if($quantity > $product->getStock()) {
                    $quantity = $product->getStock();
                }
                $cartebdd = new Carte();
                $cartebdd
                    ->setUser($user)
                    ->setProduct($product)
                    ->setQuantity($quantity);
                $this->em->persist($cartebdd);
            }else{
                $quantity2 = $cartebdd->getQuantity() + $quantity;
                if($quantity2 > $product->getStock()) {
                    $quantity2  = $product->getStock();
                }
                $cartebdd->setQuantity($quantity2);
                $carte[$id] = $quantity2;
                $this->em->persist($cartebdd);
            }

        }
        $this->em->flush();
        
        $carte = [];
        $allcartes = $this->em->getRepository(Carte::class)->findBy(["user"=>$user,"status"=>0]);
        foreach($allcartes as $one)$carte[$one->getId()] = $one->getQuantity();
            
        $this->em->flush();

        $session->set("carte",$carte);
    }
}