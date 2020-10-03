<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Port\Query\Greetings;
use App\Domain\Greeter\Greeting;

class GreetingsRepository implements Greetings
{
    public function byName(string $name): Greeting
    {
        return Greeting::fromName($name);
    }
}
