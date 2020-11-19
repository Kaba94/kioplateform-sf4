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
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Regex;

class PrestationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('prix', MoneyType::class, [
            'invalid_message' => "Veuillez indiquer un prix.",
            'scale' => 5,
            'constraints' => [
                new NotBlank(['message' => 'Le champ prix est manquant.']),
                new PositiveOrZero(['message' => 'Le prix ne peut pas être négatif.']),
                new Regex( array( 'pattern' => '/[0-9]{1,}\.[0-9]{5}/')),
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
