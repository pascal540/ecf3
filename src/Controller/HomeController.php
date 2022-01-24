<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="home")
     */
    public function index(EvenementRepository $repo): Response
    {
        $evenements = $repo->findBy([], array('createdAt' => 'DESC'), 2);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'EvenementsController',
            'evenements' => $evenements,
            'i' => 0
        ]);

        // return $this->render('home/index.html.twig', [
        //     'controller_name' => 'HomeController',
        // ]);
    }
}
