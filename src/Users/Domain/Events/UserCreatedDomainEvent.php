<?php

namespace App\Users\Domain\Events;

use App\Shared\Domain\Event\DomainEvent;

class UserCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        private string $aggregateId,
        private string $email,
        string $eventId = null,
        string $occurredOn = null,
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public function email(): string
    {
        return $this->email;
    }

    public static function deserialize(
        string $aggregateId,
        array  $body,
        string $eventId,
        string $occurredOn,
    ): DomainEvent {
        return new self($aggregateId, $body['email'], $eventId, $occurredOn);
    }

    public function serialize(): array
    {
        return [
            'fountainId' => $this->aggregateId(),
            'email' => $this->email(),
            'eventId' => $this->eventId(),
            'occurred_on' => $this->occurredOn(),
        ];
    }

    public static function eventName(): string
    {
        return 'fountains.1.event.user.created';
    }
}
