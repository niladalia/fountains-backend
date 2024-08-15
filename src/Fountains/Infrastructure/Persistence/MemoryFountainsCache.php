<?php

namespace App\Fountains\Infrastructure\Persistence;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainsCache;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Fountains\Domain\ValueObject\FountainProviderId;

class MemoryFountainsCache implements FountainsCache
{
    /**
     * @var Fountain[]
     */
    private array $fountainsCacheByProvider = [];

    /**
     * @var Fountain[]
     */
    private array $fountainsCacheByLocation = [];

    public function findByProvider(FountainProviderName $provider, FountainProviderId $providerId): ?Fountain
    {
        return $this->fountainsCacheByProvider[$this->cacheProviderKey($provider, $providerId)] ?? null;
    }

    public function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain
    {
        return $this->fountainsCacheByLocation[$this->cacheLocationKey($lat, $long)] ?? null;
    }

    public function add(Fountain $fountain)
    {
        if ($fountain->provider_id()->isPresent()) {
            $this->fountainsCacheByProvider[$this->cacheProviderKey($fountain->provider_name(), $fountain->provider_id())] = $fountain;
        }
        $this->fountainsCacheByLocation[$this->cacheLocationKey($fountain->lat(), $fountain->long())] = $fountain;
    }

    public function reset()
    {
        $this->fountainsCacheByProvider = [];
        $this->fountainsCacheByLocation = [];
    }

    private function cacheProviderKey(FountainProviderName $provider, FountainProviderId $providerId): string
    {
        return "{$provider->getValue()},{$providerId->getValue()}";
    }

    private function cacheLocationKey(FountainLat $lat, FountainLong $long): string
    {
        return "{$lat->getValue()},{$long->getValue()}";
    }
}
