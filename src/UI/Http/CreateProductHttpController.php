<?php

namespace App\UI\Http;

use App\Application\Command\CreateProduct;
use App\UI\Http\Request\CreateProductRequest;
use App\UI\Http\Response\CreateProductResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateProductHttpController extends AbstractController
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateProductRequest $createProductRequest): JsonResponse
    {
        try {
            $createProduct = new CreateProduct(
                $createProductRequest->id(),
                $createProductRequest->categoryId(),
                $createProductRequest->name(),
                $createProductRequest->description(),
                $createProductRequest->amount(),
                $createProductRequest->currency()
            );

            $this->commandBus->dispatch($createProduct);
        } catch (\Throwable $e) {
            return new JsonResponse(
                [
                    'error' => true,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        return CreateProductResponse::fromCommand($createProduct);
    }
}