<?php

namespace App\UI\Http;

use App\Entity\Product;
use App\Repository\DoctrineProductRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetProductsHttpController extends AbstractController
{
    private DoctrineProductRepository $productRepository;

    public function __construct(DoctrineProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $categoryId = Uuid::fromString($request->query->get('category_id'));

        $products = $this->productRepository->findBy(
            ['categoryId' => $categoryId]
        );

        return new JsonResponse(
            [
                'data' => array_map(
                    static fn(Product $product): array => [
                        'type' => 'products',
                        'id' => $product->id(),
                        'attributes' => [
                            'title' => $product->name(),
                            'description' => $product->description(),
                            'price' => sprintf(
                                '%s %s',
                                $product->price()->getAmount(),
                                $product->price()->getCurrency()
                            ),
                        ],
                    ],
                    $products
                ),
            ]
        );
    }
}