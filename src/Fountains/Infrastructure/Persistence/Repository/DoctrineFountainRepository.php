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
        return $this->getEntityManager()->find(Fountain::class, $id);
    }

    public function search(): ?Fountains
    {
        $fountains = $this->findBy([]);

        return new Fountains($fountains);
    }

    public function findByProvider(FountainProviderName $providerName, FountainProviderId $provider_id): ?Fountain
    {
        $qb = $this->createQueryBuilder('fountains')
            ->where('fountains.provider_name.value = :provider_name AND fountains.provider_id.value = :provider_id')
            ->setParameter("provider_name", $providerName->getValue())
            ->setParameter("provider_id", $provider_id->getValue());

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain
    {
        $qb = $this->createQueryBuilder('fountains')
            ->where('fountains.lat.value = :lat AND fountains.long.value = :long')
            ->setParameter("lat", $lat->getValue())
            ->setParameter("long", $long->getValue());

        return $qb->getQuery()->getOneOrNullResult();
    }
}