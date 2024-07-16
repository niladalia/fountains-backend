<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;

interface FountainRepository
{
    public function save(Fountain $fountain): void;
    public function findById(FountainId $id): ?Fountain;
    public function search(): ?Fountains;
    public function findByFilter(?FountainFilter $filter): ?Fountains;
    public function findByProvider(FountainProviderName $providerName, FountainProviderId $provider_id): ?Fountain;
}