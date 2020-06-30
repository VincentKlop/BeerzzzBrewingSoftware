<?php declare(strict_types=1);

namespace App\Service;

use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class PaginationService
{
    private const DEFAULT_PAGE_QUERY_PARAMETER = 'page';

    /** @var RequestStack */
    private $requestStack;

    /** @var PaginatorInterface */
    private $paginator;

    /** @var int */
    private $defaultLimit = 10;

    /** @var string */
    private $defaultPageQueryParameter = self::DEFAULT_PAGE_QUERY_PARAMETER;

    public function __construct(
        RequestStack $requestStack,
        PaginatorInterface $paginator,
        int $defaultLimit = 10,
        string $defaultPageQueryParameter = self::DEFAULT_PAGE_QUERY_PARAMETER
    ) {
        $this->requestStack = $requestStack;
        $this->paginator = $paginator;
        $this->defaultLimit = $defaultLimit;
        $this->defaultPageQueryParameter = $defaultPageQueryParameter;
    }

    public function paginate($target, ?int $page = null, ?int $limit = null, array $options = []): PaginationInterface
    {
        $request = $this->requestStack->getCurrentRequest();
        $page = $page ?? $request->query->getInt($this->defaultPageQueryParameter, 1);
        $limit = $limit ?? $this->defaultLimit;
        return $this->paginator->paginate($target, $page, $limit, $options);
    }
}
