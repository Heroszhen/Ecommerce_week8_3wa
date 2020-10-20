<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ConnectionController extends AbstractController
{
    /**
     * @Route("/inscription", name="registerpage")
     */
    public function index(Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
        if($this->getUser())return $this->redirectToRoute('homepage');
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        $session->set("nav","register");

        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $found = $em->getRepository(User::class)->findBy(["email"=>$user->getEmail()]);
                if(count($found) == 0){
                    $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                    $user->setPassword($password);
                    $user->setRoles(["ROLE_USER"]);
                    $user->setCreated(new \DateTime());
                    $em->persist($user);
                    $em->flush();

                    $message = "Votre inscription a été faite avec succès";
                    $this->addFlash('success', $message);

                    $user = new User();
                    $form = $this->createForm(UserType::class,$user);
                }else{
                    $message = "Il existe un autre utilisateur avec cet email";
                    $this->addFlash('danger', $message);
                }
            }else{
                $message = "Erreurs";
                $this->addFlash('danger', $message);
            }
        }
        return $this->render('connection/index.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="connexionpage")
     */
    public function login(Request $request,AuthenticationUtils $authenticationUtils){
        if($this->getUser())return $this->redirectToRoute('homepage');
        $session = $request->getSession();
        $session->set("nav","register");
		$error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        if (!empty($error)) {
            $this->addFlash('error', 'Identifiants incorrects');
        }
        return $this->render('connection/login.html.twig',[
            'last_username' => $lastUsername
        ]);
	}

    /**
     * @Route("/logout")
     */
    public function logout()
    {
        //Cette méthode peut rester vide, il faut juste que sa route existe
        // pour être passée dans la section logout de config/packages/security.yaml
        //return $this->redirectToRoute('homepage');
    }
}
