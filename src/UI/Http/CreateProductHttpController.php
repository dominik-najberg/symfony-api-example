<?php declare(strict_types=1);

namespace App\UI\Http;

use App\Application\Command\CreateProduct;
use App\Application\MessageBus\CommandBus;
use App\UI\Http\Request\CreateProductRequest;
use App\UI\Http\Response\CreateProductResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateProductHttpController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateProductRequest $createProductRequest): JsonResponse
    {
        $command = new CreateProduct(
            $createProductRequest->id(),
            $createProductRequest->categoryId(),
            $createProductRequest->name(),
            $createProductRequest->description(),
            $createProductRequest->amount(),
            $createProductRequest->currency()
        );

        $this->commandBus->dispatch($command);

        return CreateProductResponse::fromCommand($command);
    }
}
