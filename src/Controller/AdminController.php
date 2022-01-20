<?php

namespace App\Controller;

use App\Entity\Actualites;

use App\Entity\Evenement;
use App\Form\ActualitesType;
use App\Form\AdministrationType;
use App\Repository\EvenementRepository;
use App\Repository\ActualitesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function ajout(
        Request $request,
        EntityManagerInterface $manager
    ): Response {

        $evenement = new Evenement();
        $actualite = new Actualites();

        $formEvent = $this->createForm(AdministrationType::class, $evenement);
        $formEvent->handleRequest($request);

        $formActue = $this->createForm(ActualitesType::class, $actualite);
        $formActue->handleRequest($request);


        if ($formEvent->isSubmitted() && $formEvent->isValid()) {

            if (!$evenement->getId()) {
                $evenement->setCreatedAt(new \DateTime());
            }


            $manager->persist($evenement);
            $manager->flush();
            return $this->redirectToRoute(
                'admin',
                ['id' => $evenement->getId()]
            );
        }
        if ($formActue->isSubmitted() && $formActue->isValid()) {

            if (!$actualite->getId()) {
                $actualite->setCreatedAt(new \DateTime());
            }


            $manager->persist($actualite);
            $manager->flush();
            return $this->redirectToRoute(
                'admin',
                ['id' => $actualite->getId()]
            );
        }

        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
            'formEvent' => $formEvent->createView(),
            'formActue' => $formActue->createView()

        ]);
    }

    /**
     * @Route("/modification/{id}", name="actue_modifie")
     */
    public function modifie(
        Request $request,
        EntityManagerInterface $manager
    ) {
        //$actualite = new Actualites();
        //dd($actualite);
        // $formActue = $this->createForm(ActualitesType::class, $actualite);
        // $formActue->handleRequest($request);

        return $this->redirectToRoute(
            'actualites',
            // ['id' => $actualite->getId()]

        );
        // return $this->render('admin/modifie.html.twig', [
        //     'controller_name' => 'AdminController',
        //     'formActue' => $formActue->createView()

        // ]);
    }
}