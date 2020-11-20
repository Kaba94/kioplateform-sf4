<?php

namespace App\Form;

use App\Entity\Shoot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShootType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('start', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et heure'
            ])
            
            ->add('plateform', EntityType::class, [
                'class' => 'App\Entity\Plateform', 
                'choice_label' => 'nom' 
                ])                            
             ->add('campagne', EntityType::class, [
                'class' => 'App\Entity\Campagne', 
                'choice_label' => 'nom' 
             ])
            ->add('routeur', EntityType::class, [
                'class' => 'App\Entity\Routeur', 
                'choice_label' => 'nom' 
             ])
             ->add('annonceur', EntityType::class, [
                'class' => 'App\Entity\Annonceur', 
                'choice_label' => 'nom' 
             ])
            ->add('volume', IntegerType::class)
            ->add('description', TextareaType::class, [
                'label' => 'Commentaire'
            ])
            ->add('backgroundColor', ColorType::class, [
                'label' => 'Couleur'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shoot::class,
        ]);
    }
}
