<?php

namespace App\Fountains\Domain;

use App\Shared\Domain\ValueObject\CoordinatesLat;
use App\Shared\Domain\ValueObject\CoordinatesLong;

class RadiusFilter
{
    public function __construct(
      private CoordinatesLat $lat,
      private CoordinatesLong $long,
      private float $radius
    ) { }

    public function lat(): CoordinatesLat
    {
        return $this->lat;
    }

    public function long(): CoordinatesLong
    {
        return $this->long;
    }

    public function radius(): float
    {
        return $this->radius;
    }
}
