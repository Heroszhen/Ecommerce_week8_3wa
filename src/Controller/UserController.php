<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package App\Controller
 *
 * @Route("/espace-personnel")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/profil/{id}", name="profilepage")
     */
    public function index(User $user,Request $request)
    {
        if(!$this->getUser())return $this->redirectToRoute('homepage');

        $session = $request->getSession();
        $session->set("nav","profile");
        return $this->render('user/index.html.twig', [
            
        ]);
    }
}
