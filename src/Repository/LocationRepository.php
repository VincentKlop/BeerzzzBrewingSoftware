<?php

namespace App\Repository;

use App\Entity\Brewery;
use App\Entity\Location;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }

    public function getLocationsForUserQueryBuilder(User $user): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('location');
        $queryBuilder->leftJoin('location.brewery', 'brewery');
        $queryBuilder->join('brewery.users', 'user');
        $queryBuilder->andWhere('user = :user');
        $queryBuilder->setParameter('user', $user);

        return $queryBuilder;
    }
}
