<?php

namespace App\Repository;

use App\Entity\RecipeHopRows;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecipeHopRows|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeHopRows|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeHopRows[]    findAll()
 * @method RecipeHopRows[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeHopRowsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeHopRows::class);
    }
}
