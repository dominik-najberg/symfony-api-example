<?php

namespace App\Tests\Util\Seeder;

use Doctrine\Persistence\ObjectManager;

class DbSeeder implements Seeder
{
    private ObjectManager $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function load(array $entities): void
    {
        foreach ($entities as $entity) {
            $this->manager->persist($entity);
        }

        $this->manager->flush();
    }
}
