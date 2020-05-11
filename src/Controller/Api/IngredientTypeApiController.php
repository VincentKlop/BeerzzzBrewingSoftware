<?php

namespace App\Controller\Api;

use App\Entity\IngredientType;
use App\Entity\UnitOfMeasure;
use App\Form\IngredientTypeType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/ingredient-type")
 */
class IngredientTypeApiController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/unit-of-measures", methods={"GET"}, name="IngredientTypeUnitOfMeasuresApi")
     *
     * @return JsonResponse
     */
    public function unitOfMeasures(Request $request): JsonResponse
    {
        $ingredientTypeRepository = $this->entityManager->getRepository(IngredientType::class);
        $ingredientType = $ingredientTypeRepository->find($request->query->get('ingredientTypeId'));

        $unitOfMeasureRepository = $this->entityManager->getRepository(UnitOfMeasure::class);
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $unitOfMeasureRepository->findUnitOfMeasureBelongingToIngredientTypeQueryBuilder($ingredientType);
        $unitOfMeasures = $queryBuilder->getQuery()->getArrayResult();

        return new JsonResponse($unitOfMeasures);
    }
}
