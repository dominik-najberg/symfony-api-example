<?php declare(strict_types=1);

namespace App\Application\Adapters\Http;

use App\Application\Adapters\Http\Response\HelloWorldResponse;
use App\Application\Port\Query\Greetings;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GreetingHttpAdapter
{
    private Greetings $greeting;

    public function __construct(Greetings $greeting)
    {
        $this->greeting = $greeting;
    }

    public function __invoke(Request $request): Response
    {
        return HelloWorldResponse::fromGreeting(
            $this->greeting->byName($request->get('name'))
        );
    }
}
