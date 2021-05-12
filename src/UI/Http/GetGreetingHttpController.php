<?php declare(strict_types=1);

namespace App\UI\Http;

use App\Factory\GreetingFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetGreetingHttpController extends AbstractController
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
