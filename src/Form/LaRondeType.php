<?php

namespace App\Form;

use App\Entity\LaRonde;
use App\Repository\SiteRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LaRondeType extends AbstractType
{
    public function __construct(SiteRepository $siteRepository)
    {
        $this->siteRepository = $siteRepository;
    }

    public function getSites(){
        $sites = $this->siteRepository->findAll();
        $choices = [];
        foreach ($sites as $site) {
            $key = $site->getId().' - '.$site->getNom();
            $choices[$key] = $site;
        }
        return $choices;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           /* ->add('date_fin',TextType::class, [
                'label' => 'Date de fin',
                'attr' => [
                    'class' => 'datepicker',
                    'placeholder' => 'Date de fin',
                    'readonly' => 'readonly',
                    'id' => 'date_fin'
                ],
            ]) 
            */
            ->add('date_debut',DateType::class, [
                'label' => 'Date de début',
                'attr' => [
                    'class' => 'datepicker',
                    'placeholder' => 'Date de début',
                    'readonly' => 'readonly',
                    'id' => 'date_debut',
                    'value' => date('Y-m-d')
                ],
            ])
            ->add('site',ChoiceType::class, [
                'choices'  => $this->getSites(),
                ]
                    )
            ->add('materiel',MaterielType::class)
            ->add('data',HiddenType::class, [
                'mapped' => false,
                'attr' => [
                    'class' => 'data',
                    'id' => 'data-events'
                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LaRonde::class,
        ]);
    }
}
