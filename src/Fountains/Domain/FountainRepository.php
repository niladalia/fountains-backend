<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Shared\Domain\Repository\DatabaseRepository;

/**
 * @implements DatabaseRepository<Fountain>
 */
interface FountainRepository extends DatabaseRepository
{
    public function findById(FountainId $id): ?Fountain;
    public function findByFilter(FountainsFilter $filter): Fountains;
    public function findByBoundingBox(BoundingBox $boundingBox): Fountains;
    public function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain;
    public function findByProvider(FountainProviderName $providerName, FountainProviderId $provider_id): ?Fountain;
}