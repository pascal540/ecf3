<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementsController extends AbstractController
{
    /**
     * @Route("/evenements", name="evenements")
     */
    public function evenements(): Response
    {
        return $this->render('evenements/evenements.html.twig', [
            'controller_name' => 'EvenementsController',
            'title' => "Evenements"
        ]);
    }
}
