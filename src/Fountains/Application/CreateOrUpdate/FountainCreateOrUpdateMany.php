<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\CreateOrUpdate\DTO\CreateOrUpdateFountainRequest;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainsCache;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

class FountainCreateOrUpdateMany extends FountainCreateOrUpdate
{
    private const int QUEUE_BATCH_SIZE = 1000;

    public function __construct(protected FountainsCache $fountainsCache) {}

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

    protected function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain
    {
        // Look if a fountain is already queued
        // Otherwise look if the fountain exists in the database
        return $this->fountainsCache->find($lat, $long)
            ?: $this->fountainRepository->findByLocation($lat, $long);
    }
}