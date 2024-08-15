<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\CreateOrUpdate\DTO\CreateOrUpdateFountainRequest;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\FountainsCache;
use App\Fountains\Application\Create\FountainCreator;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Fountains\Domain\ValueObject\FountainProviderId;

class FountainCreateOrUpdateMany extends FountainCreateOrUpdate
{
    private const int QUEUE_BATCH_SIZE = 1000;

    public function __construct(
        protected FountainsCache $fountainsCache,
        FountainRepository $fountainRepository,
        private FountainCreator $fountainCreator
    ) {
        parent::__construct($fountainRepository,$fountainCreator);
    }

    /**
     * @param CreateOrUpdateFountainRequest[] $fountainRequests
     */
    public function __invoke(array $fountainRequests)
    {
        $process = function(CreateOrUpdateFountainRequest $fountainRequest) {
            $fountain = $this->queue($fountainRequest);
            $this->fountainsCache->add($fountain);
        };
        $onApply = function() {
            $this->fountainsCache->reset();
        };
        $this->fountainRepository->processInBatches(
            $fountainRequests, $process, self::QUEUE_BATCH_SIZE, $onApply
        );
    }

    protected function findByProvider(FountainProviderName $provider, FountainProviderId $providerId): ?Fountain
    {
        // Look if a fountain by provider is already queued
        // Otherwise look if the fountain exists in the database
        return $this->fountainsCache->findByProvider($provider, $providerId)
        ?: $this->fountainRepository->findByProvider($provider, $providerId);
    }

    protected function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain
    {
        // Look if a fountain by location is already queued
        // Otherwise look if the fountain exists in the database
        return $this->fountainsCache->findByLocation($lat, $long)
            ?: $this->fountainRepository->findByLocation($lat, $long);
    }
}