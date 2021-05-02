<?php

namespace App\Tests\Unit\Domain\Product\Value;

use App\Domain\Product\Exception\InvalidDescription;
use App\Domain\Product\Value\Description;
use PHPUnit\Framework\TestCase;

class DescriptionTest extends TestCase
{
    private const MINIMUM_LENGTH = 100;

    /**
     * @test
     */
    public function shouldCreate(): void
    {
        $description = str_repeat('a', self::MINIMUM_LENGTH);
        $actual      = new Description($description);

        self::assertEquals($description, $actual->description());
    }

    /**
     * @test
     */
    public function shouldThrowExceptionOnDescriptionTooShort(): void
    {
        $description = 'too short';
        $this->expectException(InvalidDescription::class);

        new Description($description);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionOnDescriptionTooLong(): void
    {
        $description = str_repeat('too loooooooong', 100);
        $this->expectException(InvalidDescription::class);

        new Description($description);
    }
}
