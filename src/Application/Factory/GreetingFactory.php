<?php declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\Port\Query\Greetings;
use App\Domain\Greeter\Greeting;

class GreetingFactory implements Greetings
{
    public function byName(string $name): Greeting
    {
        return Greeting::byName($name);
    }
}
