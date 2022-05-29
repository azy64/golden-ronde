<?php

namespace App\Form;

use App\Entity\Site;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'p-1 w-100',
                ],
                'label_attr' => ['class' => 'fs-4'],
                'row_attr' => [
                    'class' => 'w-100 m-1',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre nom',
                    ]),
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'Adresse',
                    'class' => 'p-1 w-100',
                ],
                'label_attr' => ['class' => 'fs-4'],
                'row_attr' => [
                    'class' => 'w-100 m-1',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre adresse',
                    ]),
                ],
            ])
            ->add('nombre_pointeaux', null, [
                'label' => 'Nombre de pointeaux',
                'label_attr' => ['class' => 'fs-4'],
                'attr' => [
                    'placeholder' => 'Nombre de pointeaux',
                    'class' => 'p-1 w-100',
                ],
                'label_attr' => ['class' => 'fs-4'],
                'row_attr' => [
                    'class' => 'w-100 m-1',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le nombre de pointeaux',
                    ]),
                ],
            ])
            ->add('superviseur', TextType::class, [
                'label' => 'Superviseur',
                'label_attr' => ['class' => 'fs-4'],
                'attr' => [
                    'class' => 'p-1 w-100',
                    'data-placeholder' => 'Sélectionnez un superviseur',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un superviseur',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Site::class,
        ]);
    }
}
