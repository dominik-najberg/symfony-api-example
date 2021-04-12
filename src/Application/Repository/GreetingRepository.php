<?php

namespace App\Application\Repository;

interface GreetingRepository
{
    public function byName(string $name);
}
