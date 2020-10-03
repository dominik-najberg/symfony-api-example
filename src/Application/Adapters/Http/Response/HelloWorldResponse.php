<?php declare(strict_types=1);

namespace App\Application\Adapters\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldResponse extends JsonResponse
{
    public static function fromName(string $message): HelloWorldResponse
    {
        return new self([
            'data' => [
                'type' => 'hello-worlds',
                'id' => 'UUID',
                'attributes' => [
                    'greeting' => $message,
                ],
            ],
        ], Response::HTTP_OK);
    }
}
