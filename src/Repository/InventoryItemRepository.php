<?php

namespace App\Repository;

use App\Entity\IngredientType;
use App\Entity\InventoryItem;
use App\Entity\Location;
use App\Entity\UnitOfMeasure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\AST\IdentificationVariableDeclaration;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\ParameterBag;

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
        $queryBuilder = $this->createListQueryBuilder();

        return $queryBuilder->getQuery()->getResult();
    }

    public function createListQueryBuilder(): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('InventoryItem');
        $queryBuilder->addSelect('UnitOfMeasure.name');
        $queryBuilder->join(IngredientType::class, 'IngredientType', 'WITH', 'InventoryItem.ingredientType = IngredientType');
        $queryBuilder->join(UnitOfMeasure::class, 'UnitOfMeasure', 'WITH', 'IngredientType.unitOfMeasurementType = UnitOfMeasure.unitOfMeasureType and UnitOfMeasure.factor = 1');
        $queryBuilder->addOrderBy('IngredientType.name', 'ASC');
        $queryBuilder->addOrderBy('InventoryItem.description', 'ASC');

        return $queryBuilder;
    }

    public static function addIngredientTypeFilter(QueryBuilder $queryBuilder, IngredientType $ingredientType): void
    {
        $queryBuilder->andWhere('IngredientType = :ingredientType');
        $queryBuilder->setParameter('ingredientType', $ingredientType);
    }

    public static function addDescriptionFilter(QueryBuilder $queryBuilder, string $description): void
    {
        $queryBuilder->andWhere('InventoryItem.description LIKE :description');
        $queryBuilder->setParameter('description', '%'.$description.'%');
    }

    public static function addLocationFilter(QueryBuilder $queryBuilder, Location $location): void
    {
        $queryBuilder->andWhere('InventoryItem.location = :location');
        $queryBuilder->setParameter('location', $location);
    }
}
