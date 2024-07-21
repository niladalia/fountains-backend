<?php

namespace App\Fountains\Domain;

final class Fountains
{
    /**
     * @var Fountain[]
     */
    private $fountains;

    /**
     * @param Fountain[] $fountains
     */
    public function __construct(array $fountains)
    {
        $this->fountains = $fountains;
    }

    public function toArray(): array
    {
        return array_map(fn($fountain) => $fountain->toArray(), $this->fountains);
    }
}
