<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function index()
    {
        return $this->render('welcome/index.html.twig');
    }
    /**
     * @Route("/hello-page", name="about")
     */
    public function hello(){
        return $this->render('about.html.twig',[
            'some_text'=>'add val'
        ]);
    }
}
