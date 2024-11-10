<?php

namespace App\Fountains\Domain\Events;

use App\Shared\Domain\Event\DomainEvent;

class FountainCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        private string $aggregateId,
        private float $lat,
        private float $long,
        private ?string $name,
        string $eventId = null,
        string $occurredOn = null,
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public function lat(): float
    {
        return $this->lat;
    }

    public function long(): float
    {
        return $this->long;
    }

    public function name(): string
    {
        return $this->name;
    }

    public static function deserialize(
        string $aggregateId,
        array  $body,
        string $eventId,
        string $occurredOn,
    ): DomainEvent {
        return new self($aggregateId, $body['name'], $body['lat'], $body['long'], $eventId, $occurredOn);
    }

    public function serialize(): array
    {
        return [
            'fountainId' => $this->aggregateId(),
            'name' => $this->name(),
            'lat' => $this->lat(),
            'long' => $this->long(),
            'eventId' => $this->eventId(),
            'occurred_on' => $this->occurredOn(),
        ];
    }

    public static function eventName(): string
    {
        return 'fountains.1.event.fountain.created';
    }
}
