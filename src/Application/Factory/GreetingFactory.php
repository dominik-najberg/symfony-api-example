<?php declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\Repository\Greetings;
use App\Domain\Greeting\Greeting;

class GreetingFactory implements Greetings
{
    public function byName(string $name): Greeting
    {
        return Greeting::byName($name);
    }
}
