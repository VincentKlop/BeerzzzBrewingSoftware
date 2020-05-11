<?php

namespace App\Repository;

use App\Entity\IngredientType;
use App\Entity\UnitOfMeasure;
use App\Entity\UnitOfMeasureType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnitOfMeasure|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnitOfMeasure|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnitOfMeasure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnitOfMeasureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnitOfMeasure::class);
    }

    public function findAll(): array
    {
        $queryBuilder = $this->createQueryBuilder('UnitOfMeasure');
        $queryBuilder->join(UnitOfMeasureType::class, 'UnitOfMeasureType', 'WITH', 'UnitOfMeasure.unitOfMeasureType = UnitOfMeasureType');
        $queryBuilder->addOrderBy('UnitOfMeasureType.name', 'ASC');
        $queryBuilder->addOrderBy('UnitOfMeasure.factor', 'ASC');

        return $queryBuilder->getQuery()->getResult();
    }

    public function findUnitOfMeasureBelongingToIngredientTypeQueryBuilder(IngredientType $ingredientType): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('unitOfMeasure');
        $queryBuilder->innerJoin(UnitOfMeasureType::class, 'unitOfMeasureType', 'WITH', 'unitOfMeasure.unitOfMeasureType = unitOfMeasureType');
        $queryBuilder->innerJoin(IngredientType::class, 'ingredientType', 'WITH', 'ingredientType.unitOfMeasurementType = unitOfMeasureType');
        $queryBuilder->where('ingredientType = :ingredientType');
        $queryBuilder->setParameter('ingredientType', $ingredientType);

        return $queryBuilder;
    }

    public function findDefaultUnitOfMeasureBelongingToIngredientType(IngredientType $ingredientType): ?UnitOfMeasure
    {
        $queryBuilder = $this->findUnitOfMeasureBelongingToIngredientTypeQueryBuilder($ingredientType);
        $queryBuilder->andWhere('unitOfMeasure.factor = 1');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
