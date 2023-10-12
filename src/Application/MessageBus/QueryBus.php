<?php declare(strict_types=1);

namespace App\Application\MessageBus;

interface QueryBus
{
    /**
     * @param mixed $query
     * @return mixed
     */
    public function query($query);
}
