<?php declare(strict_types=1);

namespace App\Infrastructure\EventListener;

class EventStoreMessage
{
    private string $type;
    private string $body;

    public function __construct(string $type, string $body)
    {
        $this->type = $type;
        $this->body = $body;
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
