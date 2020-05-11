<?php

namespace App\Form;

use App\Entity\IngredientTypeField;
use App\Entity\InventoryItemFieldValue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InventoryItemFieldValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'ingredientTypeField',
            EntityType::class,
            [
                'class' => IngredientTypeField::class,
                'disabled' => true,
                'label' => false,
            ]
        );

        $builder->add(
            'value',
            TextType::class,
            [
                'label' => false
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InventoryItemFieldValue::class,
        ]);
    }
}
