<?php

namespace App\Form;

use App\Entity\Pointaux;
use App\Repository\SiteRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointauxType extends AbstractType
{
    public function __construct(SiteRepository $siteRepository)
    {
        $this->siteRepository = $siteRepository;
    }
    
    public function getSites()
    {
        $tab = [];
        $sites = $this->siteRepository->findAll();
        foreach($sites as $s){
            $tab[$s->getNom()] = $s;
        }
        return $tab;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => 'Nommination du pointau *',
                'label_attr' => ['class' => 'fs-4'],
                'attr' => [
                    'placeholder' => 'Libellé',
                    'class' => 'form-control form-control-sm w-100 p-2',
                    'required' => true,
                ]
            ])
            ->add('logitude', TextType::class, [
                'label' => 'Longitude',
                'label_attr' => ['class' => 'col-sm-2 col-form-label fs-4'],
                'attr' => [
                    'placeholder' => 'Longitude',
                    'class' => 'form-control form-control-sm w-100 p-2'
                ]
            ])
            ->add('latitude', TextType::class, [
                'label' => 'Latitude',
                'label_attr' => ['class' => 'col-sm-2 col-form-label fs-4'],
                'attr' => [
                    'placeholder' => 'Latitude',
                    'class' => 'form-control form-control-sm w-100 p-2'
                ]
            ])
            ->add('site', ChoiceType::class, [
                'choices' => $this->getSites(),
                'choice_label' => function($site){
                    return $site->getNom();
                },
                'label' => 'Site *',
                'label_attr' => ['class' => 'fs-4'],
                'attr' => [
                    'class' => 'form-control form-control-sm w-100 p-2',
                    'required' => true,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pointaux::class,
        ]);
    }
}
