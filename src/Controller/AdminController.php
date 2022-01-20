<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(EvenementRepository $repo): Response
    {
        $evenements = $repo->findBy([], array('createdAt' => 'desc'));

        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
            'evenements' => $evenements,
            'i' => 0
        ]);
    }
}
