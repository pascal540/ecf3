<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{



    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(): Response
    {

        return $this->render('home/inscription.html.twig', [
            'controller_name' => 'HomeController',
            'title' => "Inscription Connexion"
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
