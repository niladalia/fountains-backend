<?php

namespace App\Providers\Domain;

use App\Providers\Domain\Provider;
use App\Providers\Domain\ValueObject\ProviderName;

use App\Shared\Domain\Repository\DatabaseRepository;

/**
 * @implements DatabaseRepository<Provider>
 */
interface ProviderRepository extends DatabaseRepository
{
    public function findByName(ProviderName $name): ?Provider;
}