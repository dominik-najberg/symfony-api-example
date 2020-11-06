<?php

namespace App\Tests\Util\Seeder;

interface Seeder
{
    public function load(array $entities): void;
}