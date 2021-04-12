<?php declare(strict_types=1);

namespace App\Adapters\Http;

use App\Adapters\Http\Response\GreetingResponse;
use App\Application\Repository\GreetingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GreetingHttpAdapter
{
    private GreetingRepository $greetings;

    public function __construct(GreetingRepository $greetings)
    {
        $this->greetings = $greetings;
    }

    public function __invoke(Request $request): Response
    {
        return GreetingResponse::fromGreeting(
            $this->greetings->byName($request->get('name'))
        );
    }
}
