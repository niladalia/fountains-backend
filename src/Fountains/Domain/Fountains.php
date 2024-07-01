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
        $fountains = [];

        foreach ($this->fountains as $book) {
            $fountains[] = $book->toArray();
        }

        return $fountains;
    }
}