<?php

namespace App\Shared\Infrastructure\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\Event\EventDispatcherInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyMessengerEventDispatcher implements EventDispatcherInterface
{
    public function __construct(private MessageBusInterface $eventBus)
    { }

    public function dispatch(DomainEvent ...$domainEvents): void
    {
        array_map(fn($event) => $this->eventBus->dispatch($event), $domainEvents);
    }
}
