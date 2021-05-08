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
        try {
            $id = Uuid::fromString($request->request->get('id'));
            $categoryId = Uuid::fromString($request->request->get('categoryId'));
            $name = new Name($request->request->get('name'));
            $description = new Description($request->request->get('description'));
            $amount = (int)$request->request->get('amount');
            $currencyCode = $request->request->get('currency');
            $money = new Money($amount, new Currency($currencyCode));
        } catch (\Throwable $e) {
            return new JsonResponse(
                [
                    'error' => true,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

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
                    'id' => $id->toString(),
                    'attributes' => [
                        'name' => $product->name()->name(),
                        'description' => $product->description()->description(),
                        'amount' => (int)$product->price()->getAmount(),
                        'currency' => $product->price()->getCurrency()->getCode(),
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