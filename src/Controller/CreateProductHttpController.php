<?php declare(strict_types=1);

namespace App\Controller;

use App\Application\Command\CreateProduct;
use App\Entity\Product;
use App\Entity\Value\Description;
use App\Entity\Value\Name;
use App\Repository\DoctrineProductRepository;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateProductHttpController
{
    private DoctrineProductRepository $productRepository;

    public function __construct(DoctrineProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(Request $request): JsonResponse
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
}
