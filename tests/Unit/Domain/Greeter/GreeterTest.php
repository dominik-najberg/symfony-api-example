<?php

namespace App\Tests\Unit\Domain\Greeter;

use App\Domain\Greeter\Greeter;
use PHPUnit\Framework\TestCase;

class GreeterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateGreeting(): void
    {
        $expected = 'Hello, Dominik!';
        $actual = Greeter::fromName('Dominik');

        self::assertEquals($expected, $actual->greet());
    }

}
