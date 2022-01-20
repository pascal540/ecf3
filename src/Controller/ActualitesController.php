<?php

namespace App\Controller;

use App\Entity\Actualites;
use Doctrine\ORM\EntityManager;
use App\Repository\ActualitesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActualitesController extends AbstractController
{

    /**
     * @Route("/actualites", name="actualites")
     */
    public function actualites(ActualitesRepository $repo): Response

    {

        $actualites = $repo->findBy([], array('createdAt' => 'DESC'));
        // var_dump($actualites);
        // die();
        return $this->render('actualites/actualites.html.twig', [
            'controller_name' => 'ActualitesController',
            'actualites' => $actualites,
            'i' => 0
        ]);
    }
}