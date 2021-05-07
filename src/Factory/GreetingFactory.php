<?php declare(strict_types=1);

namespace App\Factory;

use App\Application\Repository\GreetingRepository;
use App\Entity\Greeting;

class GreetingFactory implements GreetingRepository
{
    public function byName(string $name): Greeting
    {
        return Greeting::byName($name);
    }
}
