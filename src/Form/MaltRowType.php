<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\InventoryItem;
use App\Entity\RecipeMaltRows;
use App\Repository\InventoryItemRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaltRowType extends AbstractType
{
    private InventoryItemRepository $inventoryItemRepository;

    public function __construct(
        InventoryItemRepository $inventoryItemRepository
    ) {
        $this->inventoryItemRepository = $inventoryItemRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $queryBuilder = $this->inventoryItemRepository->findMaltInventory();

        $builder->add(
            'malt',
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

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecipeMaltRows::class,
        ]);
    }
}
