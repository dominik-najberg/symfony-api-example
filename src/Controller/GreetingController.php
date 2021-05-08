<?php declare(strict_types=1);

namespace App\Controller;

use App\Factory\GreetingFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GreetingController extends AbstractController
{
    private GreetingFactory $greetings;

    public function __construct(GreetingFactory $greetings)
    {
        $this->greetings = $greetings;
    }

    /**
     * @Route("/greetings")
     */
    public function index(Request $request): JsonResponse
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
