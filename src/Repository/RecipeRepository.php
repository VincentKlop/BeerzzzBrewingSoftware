<?php

namespace App\Repository;

use App\Entity\Recipe;
use App\Entity\RecipeMaltRows;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function findTotalMaltsForRecipe(Recipe $recipe)
    {
        $queryBuilder = $this->createQueryBuilder('recipe');
        $queryBuilder->innerJoin(RecipeMaltRows::class, 'recipeMaltRows', 'WITH', 'recipeMaltRows.recipe = recipe');
        $queryBuilder->select('SUM(recipeMaltRows.count) as totalCount');
        $queryBuilder->andWhere('recipe.id = :recipe');
        $queryBuilder->setParameter('recipe', $recipe);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
