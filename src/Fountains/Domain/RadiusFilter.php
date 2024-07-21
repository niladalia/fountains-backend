<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

class RadiusFilter
{
    public function __construct(
      private FountainLat $lat,
      private FountainLong $long,
      private int $radius
    ) { }

    public function lat(): FountainLat
    {
        return $this->lat;
    }

    public function long(): FountainLong
    {
        return $this->long;
    }

    public function radius(): int
    {
        return $this->radius;
    }

}
