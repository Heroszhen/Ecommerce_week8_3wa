<?php

namespace App\Controller;

use App\Entity\Test;
use App\Form\TestphotoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class TestController
 * @package App\Controller
 *
 * @Route("/test")
 */
class TestController extends AbstractController
{
    /**
     * @Route("/test_uploadphoto", name="testphoto")
     */
    public function index(Request $request): Response
    {
        $test = new Test();
        $form = $this->createForm(TestphotoType::class,$test);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){
                $file = $test->getPhoto();dump($file);
                $file_info = [
                    "name" => $file->getClientOriginalName(),
                    "extension" =>$file->guessExtension(),
                    "size" => $file->getSize()." octets",
                    "mimeType" => $file->getMimeType(),
                    "realPath" => $file->getRealPath(),
                    "pathname" => $file->getPathname(),
                    "maxfilesize" => $file->getMaxFilesize(),
                    "clientmimetype" => $file->getClientMimeType()
                ];
                dump($file_info);
            }
        }
        return $this->render('test/index.html.twig', [
            'formtest'=>$form->createView()
        ]);
    }
}
