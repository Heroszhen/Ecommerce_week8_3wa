<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Entity\Command;
use App\Entity\Carte;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        //dump($session->get("carte"));
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
        $comment = new Comment();
        $form = $this->createForm(CommentType::class,$comment);
        return $this->render('home/oneproduct.html.twig', [
            "product" => $product,
            "form"=>$form->createView()
        ]);
    }

    /**
     * @Route("/addcommenttoproduct/{productid}")
     */
    public function addCommentToProduct(int $productid,Request $request){
        if ($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $product = $em->find(Product::class,$productid);
            $comment = new Comment();
            $form = $this->createForm(CommentType::class,$comment);
            $form->handleRequest($request);
            if($form->isSubmitted() ) {
                if ($form->isValid()) {
                    $comment->setProduct($product);
                    $comment->setUser($this->getUser());
                    $comment->setCreated(new \DateTime());
                    $em->persist($comment);
                    $em->flush();
                }
            }
            return $this->render('home/onecommenttoproduct.html.twig', [
                "comment" => $comment
            ]);
        }
        return new Response("Error");
    }

     /**
     * @Route("/chercher-produits",name="searproductspage")
     */
    function searchProducts(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set("nav","category");
        $search = $request->request->get("search");
        $allproducts = [];
        if($search != "")$allproducts = $em->getRepository(Product::class)->moteur($search);
        //dump($allproducts);
        return $this->render('home/searchproducts.html.twig', [
            "allproducts" => $allproducts
        ]);
    }

     /**
     * @Route("/chercher-produits-category/{id}",name="searproductspage2")
     */
    function searchProductsByCategory(Category $category ,Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set("nav","category");
        $allproducts = $category->getProducts();
        return $this->render('home/searchproducts.html.twig', [
            "allproducts" => $allproducts
        ]);
    }

     /**
     * @Route("/command",name="commandpage")
     */
    function command(Request $request){
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        $carte = $session->get("carte",[]);
        foreach($carte as $pid=>$quantity){
            $product = $em->find(Product::class,$pid);
            if($product->getStock() >= $quantity){
                $carteb = $em->getRepository(Carte::class)->findOneBy(["user"=>$this->getUser(),"product"=>$product,"status"=>0]);
                if(!empty((array)$carteb)){
                    $n = $product->getStock() - $quantity;
                    $product->setStock($n);
                    $em->persist($product);

                    $carteb->setStatus(1);
                    $em->persist($carteb);

                    $command = new Command();
                    $command
                        ->setProduct($product)
                        ->setQuantity($quantity)
                        ->setUser($this->getUser())
                        ->setPrice($product->getPrice())
                        ->setcreated(new \DateTime());
                    $em->persist($command);
                    unset($carte[$pid]);
                }
            }
        }
        $em->flush();
        $carte = $session->set("carte",$carte);
        return $this->redirectToRoute('homepage');
    }
}
