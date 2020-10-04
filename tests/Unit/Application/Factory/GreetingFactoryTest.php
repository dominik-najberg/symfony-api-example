<?php

namespace App\Tests\Unit\Application\Factory;

use App\Application\Factory\GreetingFactory;
use PHPUnit\Framework\TestCase;

class GreetingFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreate(): void
    {
        $expectedGreetingMessage = 'Hello, Fabian!';
        $factory                 = new GreetingFactory();
        $actual                  = $factory->byName('Fabian');
        self::assertEquals($expectedGreetingMessage, $actual->greeting());
    }
}
