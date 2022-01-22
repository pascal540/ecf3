<?php

namespace App\Controller;

use App\Entity\Actualites;

use App\Entity\Evenement;
use App\Form\ActualitesType;
use App\Form\AdministrationType;
use App\Form\EvenementType;
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

        $formEvent = $this->createForm(EvenementType::class, $evenement);
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
     * @Route("/modification/{id}", name="actue_modifiee")
     */
    public function modifieActualite(
        Request $request,
        EntityManagerInterface $manager,
        ActualitesRepository $repo,
        Actualites $actualite
    ): Response {
        // dd($actualite);
        $actualites = $repo->findBy([], array(), $actualite->getId());

        $formActue = $this->createForm(ActualitesType::class, $actualite);
        $formActue->handleRequest($request);

        if ($formActue->isSubmitted() && $formActue->isValid()) {

            $manager->persist($actualite);
            $manager->flush();
            return $this->redirectToRoute(
                'actualites',
            );
        }

        return $this->render('admin/modifieActualie.html.twig', [
            'controller_name' => 'AdminController',
            'actualite' => $actualites,
            'formActue' => $formActue->createView()

        ]);
    }


    /**
     * @Route("/modificationEvent/{id}", name="event_modifie")
     */
    public function modifieEvenement(
        Request $request,
        EntityManagerInterface $manager,
        EvenementRepository $repo,
        Evenement $evenement
    ): Response {

        $evenements = $repo->findBy([], array(), $evenement->getId());

        $formEvenement = $this->createForm(EvenementType::class, $evenement);
        $formEvenement->handleRequest($request);
        // dd($evenement);
        if ($formEvenement->isSubmitted() && $formEvenement->isValid()) {

            $manager->persist($evenement);
            $manager->flush();
            return $this->redirectToRoute(
                'evenements',
            );
        }

        return $this->render('admin/modifieEvenements.html.twig', [
            'controller_name' => 'AdminController',
            'evenement' => $evenements,
            'formEvenement' => $formEvenement->createView()

        ]);
    }


    /**
     * @Route("/deleteActu/{id}", name="delete_actu")
     */
    public function supprimeActualite(
        Actualites $actualite,
        ActualitesRepository $repo,
        EntityManagerInterface $manager

    ): Response {

        $actues = $repo->findBy([], array(), $actualite->getId());

        $manager->remove($actualite);

        $manager->flush();

        $this->addFlash('info', 'Actualite supprimée avec succes');
        return $this->redirectToRoute(
            'actualites',
        );
    }

    /**
     * @Route("/deleteEvent/{id}", name="delete_event")
     */
    public function supprimeEvent(
        Evenement $evenement,
        EvenementRepository $repo,
        EntityManagerInterface $manager

    ): Response {

        $events = $repo->findBy([], array(), $evenement->getId());

        $manager->remove($evenement);

        $manager->flush();

        $this->addFlash('info', 'Evenement supprimé avec succes');
        return $this->redirectToRoute(
            'evenements',
        );
    }
}