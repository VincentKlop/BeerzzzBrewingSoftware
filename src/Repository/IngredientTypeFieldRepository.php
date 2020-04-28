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
}
