<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Brewery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/brewery/{brewery}/arduino")
 */
class BreweryArduinoApiController extends AbstractController
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
     * @Route("/temperatures", methods={"POST"}, name="arduinoPostApi")
     *
     * @return JsonResponse
     */
    public function arduino(Request $request, Brewery $brewery): JsonResponse
    {
        dd($brewery);
        $data = json_decode($request->getContent(), true);

        return new JsonResponse($data);
    }
}
