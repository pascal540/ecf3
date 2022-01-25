<?php

namespace App\Controller;

use App\Repository\ActualitesRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="home")
     */
    public function index(EvenementRepository $repo, ActualitesRepository $repoActu): Response
    {
        $evenements = $repo->findBy([], array('createdAt' => 'DESC'), 4);
        $actus = $repoActu->findBy([], array('createdAt' => 'DESC'), 4);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'EvenementsController',
            'evenements' => $evenements,
            'i' => 1,
            'actualites' => $actus,
            'j' => 1
        ]);

        // return $this->render('home/index.html.twig', [
        //     'controller_name' => 'HomeController',
        // ]);
    }
}
