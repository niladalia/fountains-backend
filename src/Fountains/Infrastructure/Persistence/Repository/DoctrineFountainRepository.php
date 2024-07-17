<?php

namespace App\Fountains\Infrastructure\Persistence\Repository;

use App\Fountains\Domain\ArrayToFountainFactory;
use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainFilter;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\Fountains;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Fountains\Infrastructure\Persistence\Doctrine\DoctrineFindFountainByFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineFountainRepository extends ServiceEntityRepository implements FountainRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fountain::class);
    }

    public function save(Fountain $fountain): void
    {
        $this->getEntityManager()->persist($fountain);
        $this->getEntityManager()->flush();
    }

    public function findById(FountainId $id): ?Fountain
    {
        return $this->getEntityManager()->find(Fountain::class, $id);
    }

    public function search(): ?Fountains
    {
        $fountains = $this->findBy([]);

        return new Fountains(...$fountains);
    }

    public function findByProvider(FountainProviderName $providerName, FountainProviderId $provider_id): ?Fountain
    {
        $qb = $this->createQueryBuilder('fountains')
            ->where('fountains.provider_name.value = :provider_name AND fountains.provider_id.value = :provider_id')
            ->setParameter("provider_name", $providerName->getValue())
            ->setParameter("provider_id", $provider_id->getValue());

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findByFilter(?FountainFilter $filter): ?Fountains
    {
        $factory = new ArrayToFountainFactory();

        $qb = DoctrineFindFountainByFilter::filter($this->getEntityManager()->getConnection(), $filter);
        $fountains_array = $qb->execute()->fetchAllAssociative();

        $fountains = array_map($factory, $fountains_array);

        return new Fountains(...$fountains);
    }
}