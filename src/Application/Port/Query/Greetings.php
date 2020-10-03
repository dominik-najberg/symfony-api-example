<?php

namespace App\Application\Port\Query;

interface Greetings
{
    public function byName(string $name);
}
