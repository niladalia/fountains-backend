<?php

namespace App\Providers\Infrastructure\Persistence\Repository;

use App\Providers\Domain\Provider;
use App\Providers\Domain\ProviderRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\Repository\DoctrineDatabaseRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineProviderRepository extends DoctrineDatabaseRepository implements ProviderRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Provider::class);
    }

}