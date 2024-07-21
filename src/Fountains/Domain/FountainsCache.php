<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

interface FountainsCache
{
    public function find(FountainLat $lat, FountainLong $long): ?Fountain;
    public function add(Fountain $fountain);
    public function reset();
}
