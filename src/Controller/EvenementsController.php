<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EvenementsController extends AbstractController
{
    /**
     * @Route("/evenements", name="evenements")
     */
    public function actualites(EvenementRepository $repo): Response

    {
        $evenements = $repo->findAll();
        // var_dump($actualites);
        // die();
        return $this->render('actualites/actualites.html.twig', [
            'controller_name' => 'ActualitesController',
            'actualites' => $evenements,
            'i' => 0

        ]);
    }
}
