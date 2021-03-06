<?php declare(strict_types=1);

namespace App\UI\Http\Response;

use App\Domain\Greeting\Greeting;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GreetingResponse extends JsonResponse
{
    public static function fromGreeting(Greeting $greeting): GreetingResponse
    {
        return new self([
            'data' => [
                'type'       => 'greetings',
                'id'         => 'UUID',
                'attributes' => [
                    'greeting' => $greeting->greet(),
                ],
            ],
        ], Response::HTTP_OK);
    }
}
