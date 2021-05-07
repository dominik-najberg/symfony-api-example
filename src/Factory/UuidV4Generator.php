<?php declare(strict_types=1);

namespace App\Factory;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidV4Generator
{
    public function __invoke(): UuidInterface
    {
        return Uuid::uuid4();
    }
}