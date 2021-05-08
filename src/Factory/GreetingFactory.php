<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\Greeting;

class GreetingFactory
{
    public function byName(string $name): Greeting
    {
        return Greeting::byName($name);
    }
}
