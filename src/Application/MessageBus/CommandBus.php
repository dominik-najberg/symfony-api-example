<?php declare(strict_types=1);

namespace App\Application\MessageBus;

interface CommandBus
{
    public function dispatch($message): void;
}