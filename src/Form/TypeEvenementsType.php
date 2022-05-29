<?php

namespace App\Form;

use App\Entity\TypeEvenements;
use App\Repository\TypeEvenementsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeEvenementsType extends AbstractType
{
    public function __construct(TypeEvenementsRepository $typeEvenementsRepository)
    {
        $this->typeEvenementsRepository = $typeEvenementsRepository;
    }
    public function getTypeEvents(){
        $typeEvenements = $this->typeEvenementsRepository->findAll();
        $choices = [];
        foreach ($typeEvenements as $typeEvenement) {
            $choices[$typeEvenement->getLibelle()] = $typeEvenement->getLibelle();
        }
        return $choices;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle',ChoiceType::class, [
                'choices' => $this->getTypeEvents(),
                'label' => 'Type d\'événement',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Type d\'événement',
                    'id' => 'type_evenement'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeEvenements::class,
        ]);
    }
}
