<?php

namespace App\Form;

use App\Entity\IngredientType;
use App\Entity\IngredientTypeField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add(
            'unitOfMeasurementType',
            EntityType::class,
            [
                'class' => \App\Entity\UnitOfMeasureType::class
            ]
        );
        $builder->add(
            'extraFields',
            EntityType::class,
            [
                'class' => IngredientTypeField::class,
                'multiple' => true
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IngredientType::class,
        ]);
    }
}
