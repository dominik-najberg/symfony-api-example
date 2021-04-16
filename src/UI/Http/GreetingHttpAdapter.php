<?php declare(strict_types=1);

namespace App\UI\Http;

use App\Application\Repository\GreetingRepository;
use App\UI\Http\Response\GreetingResponse;
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
