<?php

namespace App\Fountains\Domain;

use App\Shared\Domain\ValueObject\CoordinatesLat;
use App\Shared\Domain\ValueObject\CoordinatesLong;

class BoundingBox
{
    public function __construct(
      private CoordinatesLat $southLat,
      private CoordinatesLong $westLong,
      private CoordinatesLat $northLat,
      private CoordinatesLong $eastLong
    ) { }

    public function southLat(): CoordinatesLat
    {
        return $this->southLat;
    }

    public function westLong(): CoordinatesLong
    {
        return $this->westLong;
    }

    public function northLat(): CoordinatesLat
    {
        return $this->northLat;
    }

    public function eastLong(): CoordinatesLong
    {
        return $this->eastLong;
    }
}
