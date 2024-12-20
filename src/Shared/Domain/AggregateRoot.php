<?php

namespace App\Shared\Domain;

use App\Shared\Domain\Event\DomainEvent;

abstract class AggregateRoot
{
    protected array $domainEvents = [];
    public function addDomainEvent(DomainEvent $event): void
    {
        $this->domainEvents[] = $event;
    }

    public function pullDomainEvents(): array
    {
        return $this->domainEvents;
    }
}
