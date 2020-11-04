<?php

namespace App\Tests\Util\Seeder;

use Doctrine\Persistence\ObjectManager;

interface Seeder
{
    public function load(ObjectManager $manager);
}