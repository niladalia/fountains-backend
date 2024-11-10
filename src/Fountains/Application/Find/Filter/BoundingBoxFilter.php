<?php

namespace App\Fountains\Application\Find\Filter;

class BoundingBoxFilter
{
    public function __construct(
        private float $southLat,
        private float $westLong,
        private float $northLat,
        private float $eastLong,
    ) {}

    public function southLat(): float
    {
        return $this->southLat;
    }

    public function westLong(): float
    {
        return $this->westLong;
    }

    public function northLat(): float
    {
        return $this->northLat;
    }

    public function eastLong(): float
    {
        return $this->eastLong;
    }
}
