<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Fountains\Domain\ValueObject\FountainProviderId;

interface FountainsCache
{
    public function findByProvider(FountainProviderName $provider, FountainProviderId $providerId): ?Fountain;
    public function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain;
    public function add(Fountain $fountain);
    public function reset();
}
