<?php

namespace App\Form;

use App\Entity\Routeur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class RouteurFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom', TextType::class, [
            'constraints' => [
                new NotBlank(['message' => 'Le champ nom est manquant.']),
                new Length([
                    'max' => 50,
                    'maxMessage' => 'Le nombre ne peut contenir plus de {{ limit }} caractéres.'
                ])
            ]
        ])
        ->add('plateforms', EntityType::class, [
            'class' => 'App\Entity\Plateform', 
            'choice_label' => 'nom',
            'expanded' => true,
            'multiple' => true,
            'by_reference' => false,
            'required' => false
         ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Routeur::class,
        ]);
    }
}
