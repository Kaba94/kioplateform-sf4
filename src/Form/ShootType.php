<?php

namespace App\Form;

use App\Entity\Annonceur;
use App\Entity\Campagne;
use App\Entity\Plateform;
use App\Entity\Prestation;
use App\Entity\Routeur;
use App\Entity\Shoot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
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
                'choice_label' => 'nom',
                'placeholder' => 'Selectionnez une plateform',
                ])             
            ->add('annonceur', EntityType::class, [
                'class' => 'App\Entity\Annonceur', 
                'choice_label' => 'nom',
                'placeholder' => 'Selectionnez un annonceur',
             ])
            ->add('routeur', EntityType::class, [
                'class' => 'App\Entity\Routeur', 
                'choice_label' => 'nom',
                'placeholder' => 'Selectionnez un routeur',
             ])
            ->add('volume', IntegerType::class)
                 ->add('description', TextareaType::class, [
                    'label' => 'Commentaire',
            ])
            ->add('backgroundColor', ColorType::class, [
                'label' => 'Couleur'
            ])
            ->add('prestation', EntityType::class, [
                'class' => 'App\Entity\Prestation',
                'choice_label' => function(Prestation $prestation){
                    return $prestation->getRouteur()->getNom() . '/' . $prestation->getPlateform()->getNom() . ' - ' . ($prestation->getPrix() / 100000) . '€';
                },
                'label' => 'Prix',
                'placeholder' => 'Sélectionner un prix'
            ])
            ->add('base') 
            ->add('description', TextareaType::class, [
                'required' => false,
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
        //         /** @var $base Base */
        //         $base = $data->getBase();

        //         $form = $event->getForm();

        //         if($base){
        //             $routeur = $base->getRouteur();
        //             $plateform = $routeur->getPlateform();

        //             $this->addRouteurField($form, $plateform);
        //             // $this->addBaseField($form, $routeur);

        //             $form->get('plateform')->setData($plateform);
        //         } else {
        //             $this->addRouteurField($form, null);
        //             // $this->addBaseField($form, null);
        //         }
        //     }
        // );

        $builder->get('annonceur')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $annonceur = $event->getForm()->getData();
                $form = $event->getForm();
                $this->addCampagneField($form->getParent(), $form->getData());
            }    
        );

        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function(FormEvent $event){
                $data = $event->getData();
                /**  @var $campagne Campagne */
                $campagne = $data->getCampagne();

                $form = $event->getForm();

                if($campagne){
                    $annonceur = $campagne->getAnnonceur();

                    $this->addCampagneField($form, $annonceur);

                    $form->get('annonceur')->setData($annonceur);
                } else {
                    $this->addCampagneField($form, null);
                }
            }
        );
        
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

    private function addBaseField(FormInterface $form, ?Routeur $routeur)
    {
        $form->add('base', EntityType::class, [
            'class' => 'App\Entity\Base',
            'choice_label' => 'nom',
            'placeholder' => 'Sélectionner une base',
            'auto_initialize' => false,
            'choices' => $routeur ? $routeur->getBases() : [],


        ]);
    }

    private function addCampagneField(FormInterface $form, ?Annonceur $annonceur)
    {
        
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
                        'campagne',
                        EntityType::class,
                        null,
                        [
                        'class' => 'App\Entity\Campagne', 
                        'choice_label' => function (Campagne $campagne) {
                            return $campagne->getNom() . ' - ' . $campagne->getTypeDeRemuneration();},
                        'auto_initialize' => false,
                        'placeholder' => 'Selectionnez un campagne',
                        'choices' => $annonceur ? $annonceur->getCampagnes() : [],
                        ]
                    );

                    $builder->addEventListener(
                        FormEvents::POST_SUBMIT,
                        function(FormEvent $event) {
                            $form = $event->getForm();
                        }
                    );
                    $form->add($builder->getForm());
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shoot::class,
        ]);
    }
}
