<?php declare(strict_types=1);

namespace App\Tests\Integration;

use App\Tests\Util\Seeder\DbSeeder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DbTestCase extends KernelTestCase
{
    protected EntityManagerInterface $entityManager;

    protected function truncateTable(string $className): void
    {
        $this->entityManager = self::$container->get('doctrine')->getManager();

        $connection       = $this->entityManager->getConnection();
        $databasePlatform = $connection->getDatabasePlatform();
        $query            = $databasePlatform->getTruncateTableSQL(
            $this->entityManager->getClassMetadata($className)->getTableName()
        );
        $connection->executeStatement($query);
    }

    protected function seedDb(array $entities): void
    {
        $fixture = new DbSeeder($this->entityManager);
        $fixture->load($entities);
    }
}