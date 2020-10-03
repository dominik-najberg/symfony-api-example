<?php declare(strict_types=1);

namespace App\Application\Adapters\Http;

use App\Application\Adapters\Http\Response\HelloWorldResponse;
use App\Domain\Greeter\Greeter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldHttpAdapter
{
    public function __invoke(Request $request): Response
    {
        $greeter = Greeter::fromName($request->get('name'));

        return HelloWorldResponse::fromName(
            $greeter->greet()
        );
    }
}
