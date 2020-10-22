<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Entity\Command;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;




/**
 * Class UserController
 * @package App\Controller
 *
 * @Route("/espace-personnel")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/profil", name="profilepage")
     */
    public function index(Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
        if(!$this->getUser())return $this->redirectToRoute('homepage');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set("nav","profile");

        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $found = $em->getRepository(User::class)->findBy(["email"=>$user->getEmail()]);
                if(count($found) != 0 && $found[0]->getId() != $user->getId()){
                    $message = "Il existe un autre utilisateur avec cet email";
                    $this->addFlash('danger', $message);
                }else{
                    $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                    $user->setPassword($password);
                    $em->persist($user);
                    $em->flush();

                    $message = "Vos modifications ont  été enregistrées avec succès";
                    $this->addFlash('success', $message);
                }
            }else{
                $message = "Erreurs";
                $this->addFlash('danger', $message);
            }
        }

        return $this->render('user/index.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/mycommand", name="mycommandspage")
     */
    public function myCommands(Request $request){
        if(!$this->getUser())return $this->redirectToRoute('homepage');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set("nav","commands");

        $commands = $user->getCommands();
        return $this->render('user/mycommands.html.twig', [
            "commands" => $commands
        ]);
    }

    /**
     * @Route("/mes-commentaire", name="mycommentspage")
     */
    public function myComments(Request $request){
        if(!$this->getUser())return $this->redirectToRoute('homepage');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set("nav","commands");

        $comments = $user->getComments();
        return $this->render('user/mycomments.html.twig', [
            "comments" => $comments
        ]);
    }
}
