<?php

namespace App\Fountains\Domain;

final class Fountains
{
    private $fountains;
    public function __construct(Fountain ...$fountains)
    {
        $this->fountains = $fountains;
    }

    public function toArray(): array
    {
        return array_map(fn($fountain) => $fountain->toArray(), $this->fountains);
    }

}
