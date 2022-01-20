<?php

namespace App\Form;

use App\Entity\Contact;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => "nomContact"]
            ])
            ->add('prenom', TextType::class, [
                'attr' => ['class' => "prenomContact"]
            ])
            ->add('telephone', TextType::class, [
                'attr' => ['class' => "telContact"]
            ])
            ->add('email', TextType::class, [
                'attr' => ['class' => "mailContact"]
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => "textareaContact"]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}