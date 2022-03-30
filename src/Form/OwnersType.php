<?php

namespace App\Form;

use App\Entity\Owners;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class OwnersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('discription')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('city')
            ->add('address')
            ->add('postal_code')
            ->add('sold')
            ->add('heat',ChoiceType::class,[
                'choices'=>$this->getChoice()
            ] );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Owners::class,
        ]);
    }

    private function getChoice(): array
    {
        $choices = Owners::HEAT;

        $out = [];

        foreach ($choices as $key =>$value ) {
            $out[$value] = $key;
        }
        return $out;

    }
}
