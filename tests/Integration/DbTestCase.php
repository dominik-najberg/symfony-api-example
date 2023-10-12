<?php declare(strict_types=1);

namespace App\Tests\Integration;

use App\Tests\Util\Seeder\DbSeeder;
use App\Tests\Util\Seeder\DbTableTruncator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DbTestCase extends KernelTestCase
{
    protected EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

    }

    protected function truncateTable(string $className): void
    {
        (new DbTableTruncator($this->entityManager))->truncate($className);
    }

    protected function seedDb(array $entities): void
    {
        $fixture = new DbSeeder($this->entityManager);
        $fixture->load($entities);
    }
}
