<?php declare(strict_types=1);

namespace App\Adapters\Http;

use App\Adapters\Http\Request\CreateProductRequest;
use App\Application\Command\CreateProduct;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateProductHttpAdapter
{
    // TODO prepare custom message bus
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateProductRequest $createProductRequest): Response
    {
        $this->commandBus->dispatch(
            new CreateProduct(
                $createProductRequest->id(),
                $createProductRequest->name(),
                $createProductRequest->description(),
                $createProductRequest->amount(),
                $createProductRequest->currency()
            )
        );

        return new Response(null, Response::HTTP_CREATED);
    }
}
