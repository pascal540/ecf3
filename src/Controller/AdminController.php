<?php

namespace App\Controller;

use App\Entity\Actualites;
use App\Entity\Contact;
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

        $form = $this->createForm(AdministrationType::class, $evenement);
        $form->handleRequest($request);

        $form2 = $this->createForm(ActualitesType::class, $actualite);
        $form2->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

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
        if ($form2->isSubmitted() && $form2->isValid()) {

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
            'formEvent' => $form->createView(),
            'formActue' => $form->createView()

        ]);
    }
}
