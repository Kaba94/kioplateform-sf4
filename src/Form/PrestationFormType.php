<?php

namespace App\Form;

use App\Entity\Plateform;
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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
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
            ]
        ])
         ->add('plateform', EntityType::class, [
            'class' => 'App\Entity\Plateform', 
            'choice_label' => 'nom',
            'placeholder' => 'Selectionnez une plateform',
         ])
         ->add('routeur', EntityType::class, [
         'class' => 'App\Entity\Routeur', 
         'choice_label' => 'nom',
         'placeholder' => 'Selectionnez un routeur',
         ])
        ;

        $builder->get('plateform')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $plateform = $event->getForm()->getData();
                $form = $event->getForm();
                $this->addRouteurField($form->getParent(), $form->getData());
            }    
        );

        // $builder->addEventListener(
        //     FormEvents::POST_SET_DATA,
        //     function(FormEvent $event){
        //         $data = $event->getData();
        //         /**  @var $routeur Routeur */
        //         $routeur = $data->getRouteur();

        //         $form = $event->getForm();

        //         if($routeur){
        //             $plateform = $routeur->getPlateform();

        //             $this->addRouteurField($form, $plateform);

        //             $form->get('plateform')->setData($plateform);
        //         } else {
        //             $this->addRouteurField($form, null);
        //         }
        //     }
        // );


        // $builder->get('plateform')->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function (FormEvent $event) {
        //         $form = $event->getForm();
        //         $form->getParent()->add('routeur', EntityType::class, [
        //             'class' => 'App\Entity\Routeur', 
        //             'choice_label' => 'nom',
        //             'placeholder' => 'Selectionnez un routeur',
        //             'choices' => $form->getData()->getRouteur()
        //          ]);
        //     }
        // )
        // ;

        // $builder->addEventListener(
        //     FormEvents::POST_SET_DATA, function(FormEvent $event){
        //         $form = $event->getForm();
        //         $data = $event->getData();
        //         $routeur = $data->getRouteur()
        //         ;

        //         if($routeur)
        //         {
        //             $form->get('plateform')->setData($routeur->getPlateforms());

        //         $form->add('routeur', EntityType::class, [
        //             'class' => 'App\Entity\Routeur', 
        //             'choice_label' => 'nom',
        //             'placeholder' => 'Selectionnez un routeur',
        //             'choices' => $routeur->getPlateforms()->getRouteur()
        //          ]);
        //         } else {

        //             $form->add('routeur', EntityType::class, [
        //                 'class' => 'App\Entity\Routeur', 
        //                 'choice_label' => 'nom',
        //                 'placeholder' => 'Selectionnez un routeur',
        //                 'choices' => []
        //             ])
        //         ;
        //         }

                
        //     }
        // )
        // ;    
    }

    private function addRouteurField(FormInterface $form, ?Plateform $plateform)
{
    
    $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
                    'routeur',
                    EntityType::class,
                    null,
                    [
                    'class' => 'App\Entity\Routeur', 
                    'choice_label' => 'nom',
                    'auto_initialize' => false,
                    'placeholder' => 'Selectionnez un routeur',
                    'choices' => $plateform ? $plateform->getRouteur() : [],
                    ]
                );

                $builder->addEventListener(
                    FormEvents::POST_SUBMIT,
                    function(FormEvent $event) {
                        $form = $event->getForm();
                        // $this->addBaseField($form->getParent(), $form->getData());
                    }
                );
                $form->add($builder->getForm());
}


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
