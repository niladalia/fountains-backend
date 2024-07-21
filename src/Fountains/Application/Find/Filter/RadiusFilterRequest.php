<?php

namespace App\Fountains\Application\Find\Filter;

class FindFountainsByRadiusRequest
{
    public function __construct(
      private float $lat,
      private float $long,
      private float $radius
    ) { }

    public function lat(): float
    {
        return $this->lat;
    }

    public function long(): float
    {
        return $this->long;
    }

    public function radius(): float
    {
        return $this->radius;
    }
}
