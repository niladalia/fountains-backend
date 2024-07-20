<?php

namespace App\Fountains\Application\Find\Filter;

use App\Fountains\Domain\BoundingBox;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

class BoundingBoxFilter
{
    public function __construct(
      private float $southLat,
      private float $westLong,
      private float $northLat,
      private float $eastLong
    ) { }

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
