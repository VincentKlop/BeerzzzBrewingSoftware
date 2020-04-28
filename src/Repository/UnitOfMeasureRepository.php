<?php

namespace App\Repository;

use App\Entity\UnitOfMeasure;
use App\Entity\UnitOfMeasureType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
}
