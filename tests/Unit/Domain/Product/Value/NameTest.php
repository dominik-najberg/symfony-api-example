<?php

namespace App\Tests\Unit\Domain\Product\Value;

use App\Entity\Value\Name;
use App\Exception\InvalidName;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    /**
     * @test
     */
    public function should_create(): void
    {
        $expectedName = 'expected name';
        $actual       = new Name($expectedName);

        self::assertEquals($expectedName, $actual->name());
    }

    /**
     * @test
     */
    public function should_throw_on_max_length_exceeded(): void
    {
        $tooLongName = str_repeat('a', 101);
        $this->expectException(InvalidName::class);

        new Name($tooLongName);
    }
}
