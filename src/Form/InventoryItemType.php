<?php

namespace App\Form;

use App\Entity\InventoryItem;
use App\Entity\UnitOfMeasure;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InventoryItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ingredientType')
            ->add('description')
            ->add('count')
            ->add(
                'unitOfMeasure',
                EntityType::class,
                [
                    'class' => UnitOfMeasure::class,
                    "mapped" => false
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InventoryItem::class,
        ]);
    }
}
