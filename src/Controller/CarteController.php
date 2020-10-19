<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

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
            $session->set("carte",$carte);
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

        foreach($carte as $id=>$total){
            $product = $em->find(Product::class,$id);
            $oneproduct = [];
            array_push($oneproduct,$total);
            array_push($oneproduct,$product);
            $courant[] = $oneproduct;
        }
        dump($carte);
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
        return $this->redirectToRoute('cartepage');
    }
}
