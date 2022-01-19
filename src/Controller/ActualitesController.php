<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualitesController extends AbstractController
{

    /**
     * @Route("/actualites", name="actualites")
     */
    public function actualites(): Response
    {

        return $this->render('actualites/actualites.html.twig', [
            'controller_name' => 'ActualitesController',
            'title' => "Actualites"
        ]);
    }
}
