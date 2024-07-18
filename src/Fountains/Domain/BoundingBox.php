<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

class BoundingBox
{
    public function __construct(
      private FountainLat $southLat,
      private FountainLong $westLong,
      private FountainLat $northLat,
      private FountainLong $eastLong
    ) { }

    public function southLat(): FountainLat
    {
        return $this->southLat;
    }

    public function westLong(): FountainLong
    {
        return $this->westLong;
    }

    public function northLat(): FountainLat
    {
        return $this->northLat;
    }

    public function eastLong(): FountainLong
    {
        return $this->eastLong;
    }
}
