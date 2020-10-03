<?php declare(strict_types=1);

namespace App\Application\Adapters\Http\Response;

use App\Domain\Greeter\Greeting;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldResponse extends JsonResponse
{
    public static function fromGreeting(Greeting $greeting): HelloWorldResponse
    {
        return new self([
            'data' => [
                'type' => 'hello-worlds',
                'id' => 'UUID',
                'attributes' => [
                    'greeting' => $greeting->greeting(),
                ],
            ],
        ], Response::HTTP_OK);
    }
}
