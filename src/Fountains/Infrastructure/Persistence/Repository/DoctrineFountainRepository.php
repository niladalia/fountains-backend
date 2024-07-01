<?php

namespace App\Fountains\Infrastructure\Persistence\Repository;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainProviderId;
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

    public function findByProviderId(FountainProviderId $provider_id): ?Fountain
    {
        $qb = $this->createQueryBuilder('fountains')
            ->where('fountains.provider_id.value = :provider_id')
            ->setParameter("provider_id", $provider_id->getValue())
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }
}