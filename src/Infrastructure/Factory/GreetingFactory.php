<?php declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Greeting\Greeting;

class GreetingFactory
{
    public function byName(string $name): Greeting
    {
        return Greeting::byName($name);
    }
}
