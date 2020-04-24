<?php

namespace App\Repository;

use App\Entity\IngredientTypeField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IngredientTypeField|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngredientTypeField|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngredientTypeField[]    findAll()
 * @method IngredientTypeField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientTypeFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IngredientTypeField::class);
    }

    // /**
    //  * @return IngredientTypeField[] Returns an array of IngredientTypeField objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IngredientTypeField
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
