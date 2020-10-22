<?php

namespace App\Service;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class EmailService{
    
    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function test(){
        $email = (new TemplatedEmail())
            ->from(new Address('zhen.3wa@gmail.com', 'Support Client'))
            ->to(new Address("zhen.3wa@gmail.com", "zhen"))
            ->subject('test')
            ->htmlTemplate('admin/testemail.html.twig')
            ->context([])
        ;
        $this->mailer->send($email);

    }
    
}