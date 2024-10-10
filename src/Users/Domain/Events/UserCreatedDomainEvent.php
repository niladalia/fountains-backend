<?php

namespace App\Users\Domain\Events;

use App\Shared\Domain\Event\DomainEvent;

class UserCreatedDomainEvent extends DomainEvent
{
    public function __construct(private string $userId, private string $email, string $eventId = null, string $occurredOn = null)
    {
        parent::__construct($userId, $eventId, $occurredOn);
    }

    public function email(): string
    {
        return $this->email;
    }
}