<?php declare(strict_types=1);

namespace App\UI\Http;

use App\Application\Command\CreateProduct;
use App\UI\Http\Request\CreateProductRequest;
use App\UI\Http\Response\CreateProductResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateProductHttpController
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateProductRequest $createProductRequest): JsonResponse
    {
        $command = new CreateProduct(
            $createProductRequest->id(),
            $createProductRequest->name(),
            $createProductRequest->description(),
            $createProductRequest->amount(),
            $createProductRequest->currency()
        );

        $this->commandBus->dispatch($command);

        return CreateProductResponse::fromCommand($command);
    }
}
