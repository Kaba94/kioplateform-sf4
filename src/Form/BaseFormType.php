<?php

namespace App\Form;

use App\Entity\Base;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BaseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom', TextType::class, [
            'constraints' => [
                new NotBlank(['message' => 'Le champ nom est manquant.']),
                new Length([
                    'max' => 50,
                    'maxMessage' => 'Le nom ne peut contenir plus de {{ limit }} caractéres.'
                ])
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
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Base::class,
        ]);
    }
}
