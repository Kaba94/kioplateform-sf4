<?php

namespace App\Form;

use App\Data\searchData;
use App\Entity\Annonceur;
use App\Entity\Base;
use App\Entity\Campagne;
use App\Entity\Routeur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Recherche'
                ]
            ])
            ->add('routeur', EntityType::class, [
                'label' => false,
                'required' => false,
                'placeholder' => 'trier par routeur',
                'choice_label' => 'nom',
                'class' => Routeur::class,
            ])
            ->add('base', EntityType::class, [
                'label' => false,
                'required' => false,
                'placeholder' => 'Trier par base',                
                'choice_label' => 'nom',
                'class' => Base::class,
            ])
            ->add('annonceur', EntityType::class, [
                'label' => false,
                'required' => false,                
                'placeholder' => 'Trier par annonceur',                
                'choice_label' => 'nom',
                'class' => Annonceur::class,
            ])
            ->add('campagne', EntityType::class, [
                'label' => false,
                'required' => false,                
                'placeholder' => 'Trier par campagne',                
                'choice_label' => 'nom',
                'class' => Campagne::class,

            ])
            ->add('test', CheckboxType::class, [
                'required' => false,
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'crsf_protection' => false

        ])
        ;
    }

    public function getBlockPrefix()
    {
        return '';
    }
}