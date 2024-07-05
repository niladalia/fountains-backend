<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;

class FountainFinderByProvider
{
    public function __construct(private FountainRepository $fountainRepository)
    {
        $this->fountainRepository = $fountainRepository;
    }

    public function __invoke(FountainProviderName $providerName, FountainProviderId $providerId): ?Fountain
    {
        return $providerId->getValue() ? $this->fountainRepository->findByProvider($providerName, $providerId) : null;
    }
}