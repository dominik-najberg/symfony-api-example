<?php

namespace App\Tests\Unit\Infrastructure\Factory;

use PHPUnit\Framework\TestCase;

class GreetingFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreate(): void
    {
        $expectedGreetingMessage = 'Hello, Fabian!';
        $factory = new \App\Infrastructure\Factory\GreetingFactory();
        $actual = $factory->byName('Fabian');
        self::assertEquals($expectedGreetingMessage, $actual->greet());
    }
}
