<?php

namespace App\Form;

use App\Entity\UnitOfMeasure;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnitOfMeasureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('UnitOfMeasureType', EntityType::class, ['class' => \App\Entity\UnitOfMeasureType::class]);
        $builder->add('factor');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UnitOfMeasure::class,
        ]);
    }
}
