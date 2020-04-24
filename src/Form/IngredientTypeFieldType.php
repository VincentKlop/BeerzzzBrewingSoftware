<?php

namespace App\Form;

use App\Entity\IngredientType;
use App\Entity\IngredientTypeField;
use App\Entity\UnitOfMeasure;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientTypeFieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'ingredientType',
            EntityType::class,
            [
                'class' => IngredientType::class,
                'multiple' => true,
            ]
        );
        $builder->add(
            'UnitOfMeasure',
            EntityType::class,
            [
                'class' => UnitOfMeasure::class,
                'multiple' => false,
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IngredientTypeField::class,
        ]);
    }
}
