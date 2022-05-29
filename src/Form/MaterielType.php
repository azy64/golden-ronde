<?php

namespace App\Form;

use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cle', CheckboxType::class, [
                'label' => 'Clé',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                    'id' => 'cle',
                ],
            ])
            ->add('radio', CheckboxType::class, [
                'label' => 'Radio',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                    'id' => 'radio',
                ],
            ])
            ->add('phone', CheckboxType::class, [
                'label' => 'Téléphone',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                    'id' => 'phone',
                ],
            ])
            ->add('ronde')
            ->add('lamp', CheckboxType::class, [
                'label' => 'Torche',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                    'id' => 'lamp',
                ],
            ])
            ->add('contact', CheckboxType::class, [
                'label' => 'Contact',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                    'id' => 'contact',
                ],
            ])
            ->add('ivvadr', CheckboxType::class, [
                'label' => 'IVVADR',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                    'id' => 'ivvadr',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
