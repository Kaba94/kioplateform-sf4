<?php

namespace App\Form;

use App\Entity\Campagne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class CampagneFormType extends AbstractType
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
            ->add('remuneration', MoneyType::class, [
                'invalid_message' => "Veuillez indiquer un prix.",
                'constraints' => [
                    new NotBlank(['message' => 'Le champ rémunération est manquant.']),
                    new Positive(['message' => 'Le prix doit être positif.'])
                    ]
                    ])
            ->add('typeDeRemuneration', ChoiceType::class, [
                'choices' => array(
                    "CPC"=>"CPC",
                    "CPL"=>"CPL",
                    "CPA"=>"CPA",
                    "CPM"=>"CPM",
            ),
                'expanded' => true,
                'multiple' => false,
                'label' => 'Type de rémunaration'
                ])
            ->add('annonceur', EntityType::class, [
                'class' => 'App\Entity\Annonceur', 
                'choice_label' => 'nom' 
             ])
            ->add('test', CheckboxType::class, [
                'label' => 'Test'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Campagne::class,
        ]);
    }
}
