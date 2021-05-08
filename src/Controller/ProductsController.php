<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Value\Description;
use App\Entity\Value\Name;
use App\Repository\DoctrineProductRepository;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    private DoctrineProductRepository $productRepository;

    public function __construct(DoctrineProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/products", name="post-products", methods={"POST"})
     */
    public function newProduct(Request $request): JsonResponse
    {
        $id = Uuid::fromString($request->request->get('id'));
        $categoryId = Uuid::fromString($request->request->get('categoryId'));
        $name = new Name($request->request->get('name'));
        $description = new Description($request->request->get('description'));
        $amount = (int)$request->request->get('amount');
        $currencyCode = $request->request->get('currency');
        $money = new Money($amount, new Currency($currencyCode));

        $product = new Product(
            $id,
            $categoryId,
            $name,
            $description,
            $money
        );

        $this->productRepository->add($product);

        return new JsonResponse(
            [
                'data' => [
                    'type' => 'products',
                    'id' => $id,
                    'attributes' => [
                        'name' => $name,
                        'description' => $description,
                        'amount' => $money->getAmount(),
                        'currency' => $money->getCurrency()->getCode(),
                    ],
                ],
            ],
            Response::HTTP_CREATED,
        );
    }

    /**
     * @Route("/products", name="get-products", methods={"GET"})
     */
    public function productList(Request $request): JsonResponse
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
                            'title' => $product->title(),
                            'description' => $product->description(),
                            'price' => sprintf('%s %s', $product->amount(), $product->currency()),
                        ],
                    ],
                    $products
                ),
            ]
        );
    }
}