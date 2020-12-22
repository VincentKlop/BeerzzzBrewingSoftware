<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\InventoryItem;
use App\Entity\RecipeHopRows;
use App\Entity\RecipeMaltRows;
use App\Entity\UnitOfMeasure;
use App\Repository\InventoryItemRepository;
use App\Repository\UnitOfMeasureRepository;
use App\Repository\UnitOfMeasureTypeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HopRowType extends AbstractType
{
    private InventoryItemRepository $inventoryItemRepository;
    private UnitOfMeasureRepository $unitOfMeasureRepository;
    private UnitOfMeasureTypeRepository $unitOfMeasureTypeRepository;

    public function __construct(
        InventoryItemRepository $inventoryItemRepository,
        UnitOfMeasureRepository $unitOfMeasureRepository,
        UnitOfMeasureTypeRepository $unitOfMeasureTypeRepository
    ) {
        $this->inventoryItemRepository = $inventoryItemRepository;
        $this->unitOfMeasureRepository = $unitOfMeasureRepository;
        $this->unitOfMeasureTypeRepository = $unitOfMeasureTypeRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $queryBuilder = $this->inventoryItemRepository->findHopInventory();

        $unitOfMeasureTime = $this->unitOfMeasureTypeRepository->findOneBy(['name' => 'Time']);
        $unitOfMeasureTimeQueryBuilder = $this->unitOfMeasureRepository->findUnitOfMeasureByType($unitOfMeasureTime);

        $builder->add(
            'hop',
            EntityType::class,
            [
                'class' => InventoryItem::class,
                'query_builder' => $queryBuilder
            ]
        );

        $builder->add(
            'count',
            IntegerType::class
        );

        $builder->add(
            'targetAlpha',
            NumberType::class,
            [
                'scale' => 2,
                'rounding_mode' => \NumberFormatter::ROUND_HALFUP
            ]
        );

        $builder->add(
            'timeCount',
            IntegerType::class,
            [
                'required' => false
            ]
        );

        $builder->add(
            'unitOfMeasureTime',
            EntityType::class,
            [
                'class' => UnitOfMeasure::class,
                'query_builder' => $unitOfMeasureTimeQueryBuilder
            ]
        );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecipeHopRows::class,
        ]);
    }
}
