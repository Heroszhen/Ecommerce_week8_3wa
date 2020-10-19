<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;

/**
 * Class HomeController
 * @package App\Controller
 *
 */

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set("nav","home");

        $allproducts = $em->getRepository(Product::class)->findAll();

        return $this->render('home/index.html.twig', [
            "allproducts" => $allproducts
        ]);
    }

     /**
     * @Route("/produit/{id}", name="oneproductpage")
     */
    public function getOneProduct(Product $product , Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set("nav","home");

        return $this->render('home/oneproduct.html.twig', [
            "product" => $product
        ]);
    }

}
