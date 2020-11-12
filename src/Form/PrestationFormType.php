<?php

namespace App\Form;

use App\Entity\Prestation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use App\Entity\Routeur;


class PrestationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('prix', MoneyType::class, [
            'invalid_message' => "Veuillez indiquer un prix.",
            'constraints' => [
                new NotBlank(['message' => 'Le champ prix est manquant.']),
                new Positive(['message' => 'Le prix doit être positif.'])
            ]
        ])
        ->add('routeur', EntityType::class, [
            'class' => 'App\Entity\Routeur', 
            'choice_label' => 'nom' 
         ])
         ->add('plateform', EntityType::class, [
            'class' => 'App\Entity\Plateform', 
            'choice_label' => 'nom' 
         ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
