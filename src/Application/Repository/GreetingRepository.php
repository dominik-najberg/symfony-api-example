<?php

namespace App\Application\Repository;

use App\Domain\Greeting\Greeting;

interface GreetingRepository
{
    public function byName(string $name): Greeting;
}
