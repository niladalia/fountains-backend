<?php

namespace App\Providers\Domain\Services\Find;

use App\Providers\Domain\Provider;
use App\Providers\Domain\ProviderRepository;
use App\Providers\Domain\ValueObject\ProviderName;

class ProviderFinder
{
    public function __construct(protected ProviderRepository $providerRepository) {}

    /*
     * We use name as primary key in provider's table that's why we look for name
     */
    public function __invoke(ProviderName $providerName): ?Provider
    {
        return $this->providerRepository->findByName($providerName);
    }
}
