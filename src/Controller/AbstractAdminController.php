<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\PaginationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractAdminController extends AbstractController
{
    public static function getSubscribedServices()
    {
        return array_merge(parent::getSubscribedServices(), [
            PaginationService::class,
        ]);
    }

    protected function paginate($target, ?int $page = null, ?int $limit = null, array $options = [])
    {
        return $this->get(PaginationService::class)->paginate($target, $page, $limit, $options);
    }
}
