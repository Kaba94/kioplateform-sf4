<?php

namespace App\Form;

use App\Entity\Annonceur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Url;

class AnnonceurFormType extends AbstractType
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
        ->add('nomDuContact', TextType::class, [
            'constraints' => [
                new NotBlank(['message' => 'Le champ nom est manquant.']),
                new Length([
                    'max' => 50,
                    'maxMessage' => 'Le nom ne peut contenir plus de {{ limit }} caractéres.'
                ])
            ]
        ])
            ->add('skypeDuContact', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le champ nom est manquant.'])
                ]
            ])
            ->add('emailDuContact', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Email manquant.']),
                    new Length([
                        'max' => 180,
                        'maxMessage' => 'L\'adresse email ne peut contenir plus de {{ limit }} caractères.'
                    ]),
                    new Email(['message' => 'Cette adresse n\'est pas une adresse email valide.']),
                ]
            ])
            ->add('adresse', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le champ nom est manquant.']),
                ]
            ])
            ->add('codePostale', IntegerType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le champ nom est manquant.']),
                    new Length([
                        'max' => 5,
                        'maxMessage' => 'Le code postale doit contenir {{ limit }} chiffres.',
                        'min' => 5,
                        'minMessage' => 'Le code postale doit contenir {{ limit }} chiffres.',
                    ])
                ]
            ])
            ->add('ville', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le champ nom est manquant.'])
                ]
            ])
            ->add('telephone', TelType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le champ nom est manquant.']),
                    new Regex(['pattern' => '/^0\d(\s|-)?(\d{2}(\s|-)?){4}$/',
                            'message' => 'numéro de telephone attendu'
                    ])
                ]
            ])
            ->add('numeroSiret', NumberType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le champ nom est manquant.']),
                ]
            ])
            ->add('tva', NumberType::class)
            ->add('emailComptabilite', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Email manquant.']),
                    new Length([
                        'max' => 180,
                        'maxMessage' => 'L\'adresse email ne peut contenir plus de {{ limit }} caractères.'
                    ]),
                    new Email(['message' => 'Cette adresse n\'est pas une adresse email valide.']),
                ]
            ])
            ->add('contactComptabilite', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le champ nom est manquant.']),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'Le nom ne peut contenir plus de {{ limit }} caractéres.'
                    ])
                ]
            ])
            ->add('urlPlateform', UrlType::class, [
                'constraints' => [
                    new Url(['message' => 'Url attendu'])
                ]
            ])
            ->add('mdpPlateform')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonceur::class,
        ]);
    }
}
