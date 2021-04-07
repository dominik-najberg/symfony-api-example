<?php declare(strict_types=1);

namespace App\Application\MessageBus;

interface QueryBusInterface
{
    /**
     * @return mixed
     */
    public function query($query);
}
