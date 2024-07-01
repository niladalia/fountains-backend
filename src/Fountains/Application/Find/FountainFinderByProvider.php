<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;

class FountainFinderByProvider
{
    private $fountainRepository;

    public function __construct(FountainRepository $fountainRepository)
    {
        $this->fountainRepository = $fountainRepository;
    }


    public function __invoke(FountainProviderName $providerName, FountainProviderId $providerId): ?Fountain
    {
        return  !$providerId->getValue() ? null : $this->fountainRepository->findByProvider($providerName, $providerId);

    }
}