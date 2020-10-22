<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Command;
use App\Form\User2Type;
use App\Service\EmailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @package App\Controller\Admin
 *
 * @Route("/admin/user")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/tous-les-users", name="adminallusers")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        $session->set("nav","adminallusers");

        $allusers = $em->getRepository(User::class)->findAll();

        return $this->render('admin/user/index.html.twig', [
            "allusers" => $allusers
        ]);
    }

    /**
     * @Route("/modifier-user/{id}", name="adminmodifyuser")
     */
    public function modifyOneUser(User $user,Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        $session->set("nav","adminallusers");

        $form = $this->createForm(User2Type::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $found = $em->getRepository(User::class)->findBy(["email"=>$user->getEmail()]);
                if(count($found) != 0 && $found[0]->getId() != $user->getId()){
                    $message = "Il existe un autre utilisateur avec cet email";
                    $this->addFlash('danger', $message);
                }else{
                    $em->persist($user);
                    $em->flush();

                    $message = "Vos modifications ont été enregistrées avec succès";
                    $this->addFlash('success', $message);
                }
            }else{
                $message = "Erreurs";
                $this->addFlash('danger', $message);
            }
        }
        return $this->render('admin/user/modifyuser.html.twig', [
            "form" => $form->createView(),
            "user" => $user
        ]);
    }

     /**
     * @Route("/add-user", name="adminadduser")
     */
    public function addOneUser(Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        $session->set("nav","adminallusers");

        $user = new User();
        $form = $this->createForm(User2Type::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $found = $em->getRepository(User::class)->findBy(["email"=>$user->getEmail()]);
                if(count($found) != 0){
                    $message = "Il existe un autre utilisateur avec cet email";
                    $this->addFlash('danger', $message);
                }else{
                    $password = $passwordEncoder->encodePassword($user, "aaaaaaaa");
                    $user->setPassword($password);
                    $em->persist($user);
                    $em->flush();

                    $message = "Vos modifications ont été enregistrées avec succès";
                    $this->addFlash('success', $message);

                    return $this->redirectToRoute('adminallusers');
                }
            }else{
                $message = "Erreurs";
                $this->addFlash('danger', $message);
            }
        }
        return $this->render('admin/user/modifyuser.html.twig', [
            "form" => $form->createView(),
            "user" => $user
        ]);
    }

    /**
     * @Route("/testemail")
     */
    public function testEmail(Request $request,EmailService $es)
    {
        if ($request->isXmlHttpRequest()){
            $es->test();
            return new Response(1);
        }

        return new Response("Error");
        
    }

    /**
     * @Route("/tous-les-commandes", name="adminallcommands")
     */
    public function getAllCommands(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set("nav","adminallcommands");
        $allcommands = $em->getRepository(Command::class)->findAll();
        return $this->render('admin/user/allcommands.html.twig', [
            "allcommands" =>$allcommands
        ]);
    }


     /**
     * @Route("/showonecommand/{id}")
     */
    public function addOneProduct(Command $command , Request $request)
    {
        if ($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();

            return $this->render('admin/user/onecommand.html.twig', [
                "command" =>$command
            ]);
        }

        return new Response("Error");
        
    }
}
