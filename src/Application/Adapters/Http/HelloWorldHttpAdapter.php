<?php declare(strict_types=1);

namespace App\Application\Adapters\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldHttpAdapter
{
    public function __invoke(Request $request): Response
    {
        $responseText = sprintf('Hello, %s!', $request->get('name'));

        return new Response($responseText, Response::HTTP_OK);
    }
}
