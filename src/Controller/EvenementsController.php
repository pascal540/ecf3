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
    public function evenements(EvenementRepository $repo): Response

    {
        //$evenements = $repo->findAll();
        $evenements = $repo->findBy([], array('createdAt' => 'DESC'));
        return $this->render('evenements/evenements.html.twig', [
            'controller_name' => 'EvenementsController',
            'evenements' => $evenements,
            'i' => 0

        ]);
    }
}