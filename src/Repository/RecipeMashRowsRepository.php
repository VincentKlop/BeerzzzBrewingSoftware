<?php

namespace App\Repository;

use App\Entity\RecipeMashRows;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecipeMashRows|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeMashRows|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeMashRows[]    findAll()
 * @method RecipeMashRows[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeMashRowsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeMashRows::class);
    }
}
