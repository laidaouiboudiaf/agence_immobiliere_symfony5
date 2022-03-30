<?php

namespace App\Form;

use App\Entity\OwnerSearch;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OwnerSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'PRIX MAX']


            ])
            ->add('mixSurface', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'SURFACE MINIMAL']


            ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OwnerSearch::class,
            'method' => 'get',
            'csrf_protection' =>false
        ]);
    }
}
