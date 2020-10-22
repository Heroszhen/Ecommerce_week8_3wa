<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\Photo;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Knp\Component\Pager\PaginatorInterface; 
use Symfony\Component\HttpFoundation\Response;


/**
 * Class ProductController
 * @package App\Controller\Admin
 *
 * @Route("/admin/product")
 * @Security("is_granted('ROLE_ADMIN')", 
 * statusCode=403, 
 * message="Vous n'avez pas les droits suffisant pour accéder à cette interface !")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/tous-les-produits", name="adminallproducts")
     */
    public function index(Request $request,PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        $session->set("nav","adminallproducts");

        $query = $em->getRepository(Product::class)->findBy([],["id"=>"desc"]);
        $allproducts = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('admin/product/index.html.twig', [
            "allproducts" => $allproducts
        ]);
    }

    /**
     * @Route("/modifier-produit/{id}", name="adminmodifyproduct")
     */
    public function modifyOneProduct(Product $product ,Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        $session->set("nav","adminallproducts");

        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $em->persist($product);
                $em->flush();

                foreach($form->get('files')->getData() as $file){
                    $photo = new Photo();
                    $newname = uniqid() . '.' . $file->guessExtension();
                    $oldname = $file->getClientOriginalName();
                    $photo->setProduct($product)
                          ->setName($newname)
                          ->setOrigin($oldname);
                    $em->persist($photo);
                    $file->move($this->getParameter('upload_dir')."product/", $newname);
                }
                $em->flush();

                $message = "Vos modifications ont été enregistrées avec succès";
                $this->addFlash('success', $message);
            }else{
                $message = "Erreurs";
                $this->addFlash('danger', $message);
            }
        }

        return $this->render('admin/product/modifyproduct.html.twig', [
            "product" => $product,
            "form" => $form->createView()
        ]);
    }


    /**
     * @Route("/ajouter-produit", name="adminaddproduct")
     */
    public function addOneProduct(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        $session->set("nav","adminallproducts");

        $product = new Product();
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $em->persist($product);
                $em->flush();

                foreach($form->get('files')->getData() as $file){
                    $photo = new Photo();
                    $newname = uniqid() . '.' . $file->guessExtension();
                    $oldname = $file->getClientOriginalName();
                    $photo->setProduct($product)
                          ->setName($newname)
                          ->setOrigin($oldname);
                    $em->persist($photo);
                    $file->move($this->getParameter('upload_dir')."product/", $newname);
                }
                $em->flush();

                return $this->redirectToRoute('adminallproducts');
            }else{
                $message = "Erreurs";
                $this->addFlash('danger', $message);
            }
        }

        return $this->render('admin/product/modifyproduct.html.twig', [
            "form" => $form->createView(),
            "product" => $product
        ]);
    }


    /**
     * @Route("/deleteproduit/{id}", name="admindeleteproduct")
     */
    public function deleteOneProduct(Product $product,Request $request){
        $em = $this->getDoctrine()->getManager();
        foreach($product->getPhotos() as $photo){
            if($photo->getName() != "10083754155f8ded5d910e67.23748912.jpg"){
                if(file_exists($this->getParameter('upload_dir')."product/".$photo->getName()))unlink($this->getParameter('upload_dir')."product/".$photo->getName());
            }
            $em->remove($photo);
            $em->flush();
        }
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('adminallproducts');
    }

     /**
     * @Route("/deleteonephoto/{id}")
     */
    public function deleteOnePhoto(int $id, Request $request)
    {
        if ($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $photo = $em->find(Photo::class,$id);
            if($photo->getName() != "10083754155f8ded5d910e67.23748912.jpg"){
                unlink($this->getParameter('upload_dir')."product/".$photo->getName());
            }
            $em->remove($photo);
            $em->flush();
            return new Response(1);
        }

        return new Response("Error");
        
    }
}
