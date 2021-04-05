<?php declare(strict_types=1);

namespace App\Adapters\Http;

use App\Adapters\Http\Request\CreateProductRequest;
use App\Application\Command\CreateProduct;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

    /**
     * @ParamConverter("postProductRequest", class="App\Adapters\Http\Request\CreateProductRequest")
     */
    public function __invoke(CreateProductRequest $request): Response
    {
        $this->commandBus->dispatch(
            new CreateProduct(
                $request->id(),
                $request->name(),
                $request->description(),
                $request->amount(),
                $request->currency()
            )
        );

        return new Response(null, Response::HTTP_CREATED);
    }
}
