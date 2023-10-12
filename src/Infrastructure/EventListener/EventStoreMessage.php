<?php declare(strict_types=1);

namespace App\Infrastructure\EventListener;

class EventStoreMessage
{
    public function __construct(
        public readonly string $type,
        public readonly string $body,
    ) {
    }

    /**
     * @throws \JsonException
     */
    public static function create(string $type, array $body): self
    {
        return new self(
            $type,
            json_encode($body, JSON_THROW_ON_ERROR, 512)
        );
    }

    public function type(): string
    {
        return $this->type;
    }

    public function body(): string
    {
        return $this->body;
    }
}
