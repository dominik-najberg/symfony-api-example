<?php declare(strict_types=1);

namespace App\Tests\Util\Seeder;

use Doctrine\Persistence\ObjectManager;

class DbTableTruncator
{
    private ObjectManager $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function truncate(string $className): void
    {
        $connection       = $this->manager->getConnection();
        $databasePlatform = $connection->getDatabasePlatform();
        $query            = $databasePlatform->getTruncateTableSQL(
            $this->manager->getClassMetadata($className)->getTableName()
        );
        $connection->executeStatement($query);
    }
}