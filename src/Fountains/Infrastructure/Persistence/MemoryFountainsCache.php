<?php

namespace App\Fountains\Infrastructure\Persistence;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainsCache;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

class MemoryFountainsCache implements FountainsCache
{
    /**
     * @var Fountain[]
     */
    private array $fountainsCache = [];

    public function find(FountainLat $lat, FountainLong $long): ?Fountain
    {
        return $this->fountainsCache[$this->cacheKey($lat, $long)] ?? null;
    }

    public function add(Fountain $fountain)
    {
        $this->fountainsCache[$this->cacheKey($fountain->lat(), $fountain->long())] = $fountain;
    }

    public function reset()
    {
        $this->fountainsCache = [];
    }

    private function cacheKey(FountainLat $lat, FountainLong $long): string
    {
        return "{$lat->getValue()},{$long->getValue()}";
    }
}
