<?php

namespace App\Providers\Infrastructure\Persistence\Repository;

use App\Providers\Domain\Provider;
use App\Providers\Domain\ProviderRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineProviderRepository extends ServiceEntityRepository implements ProviderRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Provider::class);
    }

    public function save(Provider $provider): void
    {
        $this->getEntityManager()->persist($provider);
        $this->getEntityManager()->flush();
    }

}