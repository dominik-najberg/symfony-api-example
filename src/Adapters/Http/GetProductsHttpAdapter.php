<?php declare(strict_types=1);

namespace App\Adapters\Http;

use App\Adapters\Http\Response\GetProductsResponse;
use App\Application\MessageBus\QueryBusInterface;
use App\Application\Query\GetProducts;
use App\Application\Query\ViewModel\ProductDTO;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetProductsHttpAdapter
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(): JsonResponse
    {
        /** @var ProductDTO[] $products */
        $products = $this->queryBus->query(new GetProducts());

        return GetProductsResponse::fromProductDTOs($products);
    }
}
