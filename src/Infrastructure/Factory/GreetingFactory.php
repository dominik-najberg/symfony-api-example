<?php declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Application\Repository\GreetingRepository;
use App\Domain\Greeting\Greeting;

class GreetingFactory implements GreetingRepository
{
    public function byName(string $name): Greeting
    {
        return Greeting::fromName($name);
    }
}
