<?php declare(strict_types=1);

namespace App\Adapters\Http;

use App\Adapters\Http\Request\CreateProductRequest;
use App\Adapters\Http\Response\CreateProductResponse;
use App\Application\Command\CreateProduct;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateProductHttpAdapter
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
