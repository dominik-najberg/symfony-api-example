<?php

namespace App\Tests\Unit\Application\Adapters\Http;

use App\Adapters\Http\GreetingHttpAdapter;
use App\Application\Repository\GreetingRepository;
use App\Domain\Greeting\Greeting;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class GreetingHttpAdapterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateResponse(): void
    {
        $name     = 'Dominik';
        $greeting = Greeting::byName($name);

        $greetings = $this->createMock(GreetingRepository::class);
        $greetings
            ->expects(self::once())
            ->method('byName')
            ->willReturn($greeting);

        $request = $this->createMock(Request::class);
        $request
            ->expects(self::once())
            ->method('get')
            ->willReturn($name);

        $actual = new GreetingHttpAdapter($greetings);
        $actual($request);
    }
}
