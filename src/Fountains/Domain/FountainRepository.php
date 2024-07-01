<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainProviderId;

interface FountainRepository
{
    public function save(Fountain $fountain): void;
    public function findById(FountainId $id): ?Fountain;
    public function findByProviderId(FountainProviderId $provider_id): ?Fountain;
}