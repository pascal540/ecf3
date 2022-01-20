<?php

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(
        Request $request,
        EntityManagerInterface $manager
    ): Response {

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!$contact->getId()) {
                $contact->setCreatedAt(new \DateTime());
            }


            $manager->persist($contact);
            $manager->flush();
            return $this->redirectToRoute(
                'home',
                ['id' => $contact->getId()]
            );
        }


        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView()

        ]);
    }
}
