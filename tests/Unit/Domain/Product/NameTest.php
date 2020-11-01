<?php

namespace App\Tests\Unit\Domain\Product;

use App\Domain\Product\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreate(): void
    {
        $expectedName = 'expected name';
        $actual       = new Name($expectedName);

        self::assertEquals($expectedName, $actual->name());
    }
}
