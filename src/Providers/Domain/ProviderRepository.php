<?php

namespace App\Providers\Domain;

use App\Shared\Domain\Repository\DatabaseRepository;

/**
 * @implements DatabaseRepository<Provider>
 */
interface ProviderRepository extends DatabaseRepository
{
    
}