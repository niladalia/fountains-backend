<?php

namespace App\Shared\Domain\Event;

use App\Shared\Domain\Utils\Uuid;
use DateTimeImmutable;
use DateTimeInterface;

abstract class DomainEvent
{
    private readonly string $eventId;
    private readonly string $occurredOn;
    public function __construct(private string $aggregateId, string $eventId = null, string $occurredOn = null)
    {
        $date = new DateTimeImmutable();
        $this->eventId = $eventId ?: Uuid::generate();
        $this->occurredOn = $occurredOn ?: $date->format(DateTimeInterface::ATOM);
    }

    final public function eventId(): string
    {
        return $this->eventId;
    }

    final public function occurredOn(): string
    {
        return $this->occurredOn;
    }

    final public function aggregateId(): string
    {
        return $this->aggregateId;
    }
}
