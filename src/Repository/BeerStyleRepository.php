<?php

namespace App\Repository;

use App\Entity\BeerStyle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BeerStyle|null find($id, $lockMode = null, $lockVersion = null)
 * @method BeerStyle|null findOneBy(array $criteria, array $orderBy = null)
 * @method BeerStyle[]    findAll()
 * @method BeerStyle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeerStyleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BeerStyle::class);
    }

    public function createListQueryBuilder(): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('BeerStyle');
        $queryBuilder->addOrderBy('BeerStyle.name');

        return $queryBuilder;
    }
}
