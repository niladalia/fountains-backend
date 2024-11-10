<?php

namespace App\Tests\Fountains\Domain\Events;

use App\Fountains\Domain\Events\FountainCreatedDomainEvent;
use App\Fountains\Domain\Fountain;

class FountainCreatedDomainEventMother
{
    public static function create(
        string $aggregateId,
        float $lat,
        float $long,
        ?string $name,
    ): FountainCreatedDomainEvent {
        return new FountainCreatedDomainEvent(
            $aggregateId,
            $lat,
            $long,
            $name,
        );
    }

    public static function fromFountain(Fountain $fountain): FountainCreatedDomainEvent
    {
        return self::create(
            $fountain->id()->getValue(),
            $fountain->lat()->getValue(),
            $fountain->long()->getValue(),
            $fountain->name()->getValue(),
        );
    }
}
