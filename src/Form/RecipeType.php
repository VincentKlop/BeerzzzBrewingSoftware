<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\InventoryItem;
use App\Entity\Recipe;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'targetAlcoholVolume',
            NumberType::class,
            [
                'scale' => 2,
                'rounding_mode' => \NumberFormatter::ROUND_HALFUP
            ]
        );
        $builder->add(
            'preBoilWater',
            NumberType::class,
            [
                'label' => 'Pre-boil water (liters)',
                'scale' => 2,
                'rounding_mode' => \NumberFormatter::ROUND_HALFUP
            ]
        );
        $builder->add(
            'startSG',
            IntegerType::class,
            [
                'label' => 'Start SG'
            ]
        );
        $builder->add(
            'endSG',
            IntegerType::class,
            [
                'label' => 'End SG'
            ]
        );
        $builder->add(
            'IBU',
            IntegerType::class,
            [
                'label' => 'Bitterness (IBU)'
            ]
        );
        $builder->add(
            'targetColor',
            IntegerType::class,
            [
                'label' => 'Target Color (EBC)'
            ]
        );

        $builder->add(
            'spargeWaterAmount',
            NumberType::class,
            [
                'label' => 'Sparge water (liters)',
                'scale' => 2,
                'rounding_mode' => \NumberFormatter::ROUND_HALFUP
            ]

        );

        $inventoryItemRepository = $this->entityManager->getRepository(InventoryItem::class);
        $queryBuilder = $inventoryItemRepository->findYeastInventory();

        $builder->add(
            'yeast',
            EntityType::class,
            [
                'class' => InventoryItem::class,
                'query_builder' => $queryBuilder
            ]
        );

        $builder->add(
            'malts',
            CollectionType::class,
            [
                'entry_type' => MaltRowType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'attr' => array(
                    'class' => 'collection',
                ),
            ]
        );

        $builder->add(
            'recipeMashRows',
            CollectionType::class,
            [
                'entry_type' => MashRowType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'attr' => array(
                    'class' => 'collection',
                ),
            ]
        );

        $builder->add(
            'hops',
            CollectionType::class,
            [
                'entry_type' => HopRowType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
