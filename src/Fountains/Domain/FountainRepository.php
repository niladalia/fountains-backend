<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Shared\Domain\Repository\DatabaseRepository;

interface FountainRepository extends DatabaseRepository
{
    public function save(Fountain $fountain): void;
    public function persist(Fountain $fountain): void;
    
    public function search(): ?Fountains;
    public function findById(FountainId $id): ?Fountain;
    public function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain;
    public function findByProvider(FountainProviderName $providerName, FountainProviderId $provider_id): ?Fountain;
}