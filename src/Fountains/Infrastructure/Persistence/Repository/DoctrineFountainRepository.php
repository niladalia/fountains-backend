<?php

namespace App\Fountains\Infrastructure\Persistence\Repository;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
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
}