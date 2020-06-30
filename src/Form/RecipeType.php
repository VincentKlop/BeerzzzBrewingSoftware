<?php

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('targetAlcoholVolume')
            ->add('preBoilWater')
            ->add('startSG')
            ->add('endSG')
            ->add('IBU')
            ->add('targetColor')
            ->add('calculatedColor')
            ->add('spargeWaterAmount')
            ->add('yeast')
            ->add('malts')
            ->add('hops')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
