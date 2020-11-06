<?php declare(strict_types=1);

namespace App\Adapters\Http;

use App\Adapters\Http\Response\GetProductsResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetProductsHttpAdapter
{
    public function __invoke(): JsonResponse
    {
        return GetProductsResponse::fromProductDTO();
    }
}