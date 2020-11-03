<?php declare(strict_types=1);

namespace App\Tests\Integration;

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
}