<?php declare(strict_types=1);

namespace App\Tests\Integration;

use Doctrine\ORM\EntityManagerInterface;

trait DbTestingTrait
{
    private EntityManagerInterface $entityManager;

    private function truncateTable(string $className): void
    {
        $connection       = $this->entityManager->getConnection();
        $databasePlatform = $connection->getDatabasePlatform();
        $query            = $databasePlatform->getTruncateTableSQL(
            $this->entityManager->getClassMetadata($className)->getTableName()
        );
        $connection->executeStatement($query);
    }
}