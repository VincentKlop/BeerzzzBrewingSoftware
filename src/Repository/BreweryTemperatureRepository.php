<?php

namespace App\Repository;

use App\Entity\BreweryTemperature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BreweryTemperature|null find($id, $lockMode = null, $lockVersion = null)
 * @method BreweryTemperature|null findOneBy(array $criteria, array $orderBy = null)
 * @method BreweryTemperature[]    findAll()
 * @method BreweryTemperature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BreweryTemperatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BreweryTemperature::class);
    }

    // /**
    //  * @return BreweryTemperature[] Returns an array of BreweryTemperature objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BreweryTemperature
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
