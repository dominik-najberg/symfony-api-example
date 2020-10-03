<?php

namespace App\Tests\Unit\Domain\Greeter;

use App\Domain\Greeter\Greeting;
use PHPUnit\Framework\TestCase;

class GreetingTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateGreeting(): void
    {
        $expected = 'Hello, Dominik!';
        $actual = Greeting::fromName('Dominik');

        self::assertEquals($expected, $actual->greeting());
    }

}
