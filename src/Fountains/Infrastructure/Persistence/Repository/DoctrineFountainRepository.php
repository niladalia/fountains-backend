<?php

namespace App\Fountains\Infrastructure\Persistence\Repository;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\Fountains;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Shared\Infrastructure\Persistence\Doctrine\Repository\DoctrineDatabaseRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineFountainRepository extends DoctrineDatabaseRepository implements FountainRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fountain::class);
    }

    public function findById(FountainId $id): ?Fountain
    {
        return $this->find($id);
    }

    public function search(): ?Fountains
    {
        $fountains = $this->findAll();

        return new Fountains($fountains);
    }

    public function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain
    {
        return $this->findOneBy([
            'lat.value' => $lat->getValue(),
            'long.value' => $long->getValue()
        ]);
    }

    public function findByProvider(FountainProviderName $providerName, FountainProviderId $provider_id): ?Fountain
    {
        return $this->findOneBy([
            'provider_name.value' => $providerName->getValue(),
            'provider_id.value' => $provider_id->getValue()
        ]);
    }
}