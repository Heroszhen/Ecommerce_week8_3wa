<?php
namespace App\EventListener;

use App\Entity\User;
use App\Service\CarteService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class LoginListener
{
    private $em;
    private $cs;
    private $session;

    public function __construct(EntityManagerInterface $em,CarteService $cs,SessionInterface $session)
    {
        $this->em = $em;
        $this->cs = $cs;
        $this->session = $session;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        // Get the User entity.
        $user = $event->getAuthenticationToken()->getUser();
        //or $event->getRequest()->getSession();
        $this->cs->addBdd($user,$this->session);
    }
}