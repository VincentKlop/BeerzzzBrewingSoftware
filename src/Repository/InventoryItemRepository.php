<?php

namespace App\Repository;

use App\Entity\IngredientType;
use App\Entity\InventoryItem;
use App\Entity\UnitOfMeasure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InventoryItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method InventoryItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method InventoryItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventoryItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InventoryItem::class);
    }

    public function findAll(): array
    {
        $queryBuilder = $this->createQueryBuilder('InventoryItem');
        $queryBuilder->addSelect('UnitOfMeasure.name');
        $queryBuilder->join(IngredientType::class, 'IngredientType', 'WITH', 'InventoryItem.ingredientType = IngredientType');
        $queryBuilder->join(UnitOfMeasure::class, 'UnitOfMeasure', 'WITH', 'IngredientType.unitOfMeasurementType = UnitOfMeasure.unitOfMeasureType and UnitOfMeasure.factor = 1');
        $queryBuilder->addOrderBy('IngredientType.name', 'ASC');
        $queryBuilder->addOrderBy('InventoryItem.description', 'ASC');

        return $queryBuilder->getQuery()->getResult();
    }
}
