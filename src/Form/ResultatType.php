<?php

namespace App\Form;

use App\Entity\Resultat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResultatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('volumeEnvoye')
            ->add('resultat')
            ->add('shoot', EntityType::class, [
                'class' => 'App\Entity\Shoot',
                'choice_label' => 'title',
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Resultat::class,
        ]);
    }
}
