<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

class FountainFilter
{
    public function __construct(
        private ?FountainLat $lat = null,
        private ?FountainLong $long = null,
        private ?int $limit = null,
        private ?int $offset = null
    ) { }

    public function lat(): ?FountainLat
    {
        return $this->lat;
    }

    public function long(): ?FountainLong
    {
        return $this->long;
    }

    public function limit(): int
    {
        return $this->limit;
    }

    public function offset(): int
    {
        return $this->offset;
    }
}