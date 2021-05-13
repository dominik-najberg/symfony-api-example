<?php

namespace App\UI\Http;

use App\Domain\Product\Product;
use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use App\Infrastructure\Repository\DoctrineProductRepository;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateProductHttpController extends AbstractController
{
    private DoctrineProductRepository $productRepository;

    public function __construct(DoctrineProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $id = Uuid::fromString($request->request->get('id'));
            $categoryId = Uuid::fromString($request->request->get('categoryId'));
            $name = new Name($request->request->get('name'));
            $description = new Description($request->request->get('description'));
            $amount = (int)$request->request->get('amount');
            $currencyCode = $request->request->get('currency');
            $money = new Money($amount, new Currency($currencyCode));

            $product = new Product($id, $categoryId, $name, $description, $money);
        } catch (\Throwable $e) {
            return new JsonResponse(
                [
                    'error' => true,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        $this->productRepository->save($product);

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
}