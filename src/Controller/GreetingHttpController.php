<?php declare(strict_types=1);

namespace App\Controller;

use App\Application\Repository\GreetingRepository;
use App\Factory\GreetingFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GreetingHttpController
{
    private GreetingFactory $greetings;

    public function __construct(GreetingFactory $greetings)
    {
        $this->greetings = $greetings;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $greeting = $this->greetings->byName($request->get('name'));

        return new JsonResponse(
            [
                'data' => [
                    'type' => 'greetings',
                    'id' => 'UUID',
                    'attributes' => [
                        'greeting' => $greeting->greet(),
                    ],
                ],
            ], Response::HTTP_OK
        );
    }
}
