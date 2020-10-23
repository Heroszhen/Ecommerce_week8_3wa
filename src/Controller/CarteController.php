<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Carte;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CarteController
 * @package App\Controller
 *
 * @Route("/panier")
 */
class CarteController extends AbstractController
{
    /**
     * @Route("/addoneproduct/{id}", name="addproductincarte")
     */
    public function addOneProduct(product $product , Request $request)
    {
        if ($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();

            $session = $request->getSession();
            $carte = $session->get("carte",[]);
            $key = $product->getId();
            if(array_key_exists($key,$carte)){
                $carte[$key]++;
            }else{
                $carte[$key] = 1;
            }
            if($carte[$key] > $product->getStock()) {
                $carte[$key] = $product->getStock();
            }
            $session->set("carte",$carte);
            if($this->getUser() != null){
                $carteb = $em->getRepository(Carte::class)->findOneBy(["user"=>$this->getUser(),"product"=>$product,"status"=>0]);
                if(empty((array)$carteb)){
                    $carteb = new Carte();
                    $carteb
                        ->setProduct($product)
                        ->setUser($this->getUser());
                }
                $carteb->setQuantity($carte[$key]);;
                $em->persist($carteb);
                $em->flush();
            }
            return new Response(count($carte));
        }

        return new Response("Error");
        
    }

     /**
     * @Route("/mon-panier", name="cartepage")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set("nav","");
        $carte = $session->get("carte",[]);
        $courant = [];
        //dump($carte);
        foreach($carte as $id=>$total){
            $product = $em->find(Product::class,$id);
            $oneproduct = [];
            array_push($oneproduct,$total);
            array_push($oneproduct,$product);
            $courant[] = $oneproduct;
        }
        return $this->render('carte/index.html.twig', [
            "carte"=>$courant
        ]);
    }

     /**
     * @Route("/deleteoneproduct/{pid}", name="deleteproductfromcarte")
     */
    public function deleteOneProduct(int $pid,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $carte = $session->get("carte",[]);

        foreach($carte as $id=>$total){
            if($id == $pid){
                unset($carte[$id]);
                break;
            }
        }
        $session->set("carte",$carte);
        if($this->getUser() != null){
            $product = $em->find(Product::class,$pid);
            $carteb = $em->getRepository(Carte::class)->findOneBy(["user"=>$this->getUser(),"product"=>$product,"status"=>0]);
            $em->remove($carteb);
            $em->flush();
        }
        return $this->redirectToRoute('cartepage');
    }

    /**
     * @Route("/updatequantity/{pid}_{value}")
     */
    public function updateQuantity(int $pid,int $value , Request $request)
    {
        if ($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $n = 0;
            $session = $request->getSession();
            $carte = $session->get("carte",[]);
            $product = $em->find(Product::class,$pid);
            if($value > $product->getStock())$carte[$pid] = $product->getStock();
            else $carte[$pid] = $value;
            $session->set("carte",$carte);
            foreach($carte as $id=>$quantity){
                $product = $em->find(Product::class,$id);
                $n += $carte[$id] * $product->getPrice();
            }

            if($this->getUser() != null){
                $product = $em->find(Product::class,$pid);
                $carteb = $em->getRepository(Carte::class)->findOneBy(["user"=>$this->getUser(),"product"=>$product,"status"=>0]);
                $carteb->setQuantity($carte[$pid]);
                $em->persist($carteb);
                $em->flush();
            }
            return new JsonResponse([$carte[$pid],$n]);
        }

        return new Response("Error");
        
    }

    /**
     * @Route("/emptycart" , name="emptycart")
     */
    public function emptyCart(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set("nav","");
        $session->set("carte",[]);
        if($this->getUser() != null){
        $carteb = $em->getRepository(Carte::class)->findBy(["user"=>$this->getUser(),"status"=>0]);
            foreach($carteb as $one){
                $em->remove($one);
                $em->flush();
            }
        }
        return $this->redirectToRoute('cartepage');
    }

}
