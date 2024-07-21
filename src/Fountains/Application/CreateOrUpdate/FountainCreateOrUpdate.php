<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\Create\FountainCreator;
use App\Fountains\Application\Create\FountainCreatorQueue;
use App\Fountains\Application\Update\FountainUpdater;
use App\Fountains\Application\Update\UpdateFountainRequest;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainsCache;
use App\Fountains\Domain\FountainRepository;

class FountainCreateOrUpdate
{
    private const int QUEUE_BATCH_SIZE = 1000;

    public function __construct(
        private FountainCreatorQueue     $fountainCreator,
        private FountainUpdater          $fountainUpdater,
        private FountainRepository       $fountainRepository,
        private FountainsCache           $fountainsCache
    ) {}

    public function __invoke(CreateOrUpdateFountainRequest $fountainRequest)
    {
        $this->queue($fountainRequest);
        $this->fountainRepository->apply();
    }

    /**
     * @param CreateOrUpdateFountainRequest[] $fountainRequests
     */
    public function many(array $fountainRequests): void
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

    public function queue(CreateOrUpdateFountainRequest $fountainRequest): Fountain
    {
        $fountain = $this->findByCacheOrLocation($fountainRequest->lat(), $fountainRequest->long());

        if ($fountain) {
            $fountain = $this->mergeFountain($fountainRequest, $fountain);
        } else {
            $fountain = $this->createFountain($fountainRequest);
        }

        return $fountain;
    }

    private function findByCacheOrLocation(float $lat, float $long): ?Fountain
    {
        $fountainLat = new FountainLat($lat);
        $fountainLong = new FountainLong($long);

        // Look if a fountain is already queued
        // Otherwise look if the fountain exists in the database
        return $this->fountainsCache->find($fountainLat, $fountainLong)
            ?: $this->fountainRepository->findByLocation($fountainLat, $fountainLong);
    }

    private function createFountain(CreateOrUpdateFountainRequest $fountainRequest): Fountain
    {
        return $this->fountainCreator->__invoke($fountainRequest);
    }

    private function mergeFountain(CreateOrUpdateFountainRequest $fountainRequest, Fountain $fountain): Fountain
    {
        if (self::isSameProviderFountain($fountainRequest, $fountain)) {
            if (self::isRequestNewer($fountainRequest, $fountain)) {
                $fountain = $this->updateFountain($fountainRequest, $fountain);
            }
        } else {
            $updateFountainRequest = $this->mergeRequest($fountainRequest, $fountain);
            $fountain = $this->updateFountainFromRequest($updateFountainRequest, $fountain);
        }
        return $fountain;
    }

    private function updateFountain(CreateOrUpdateFountainRequest $fountainRequest, Fountain $fountain): Fountain
    {
        $updateFountainRequest = $fountainRequest->toUpdateFountainRequest($fountain->id()->getValue());
        return $this->updateFountainFromRequest($updateFountainRequest, $fountain);
    }

    private function updateFountainFromRequest(UpdateFountainRequest $updateFountainRequest, Fountain $fountain): Fountain
    {
        return $this->fountainUpdater->queue($updateFountainRequest, $fountain);
    }

    private static function isSameProviderFountain(CreateOrUpdateFountainRequest $fountainRequest, Fountain $fountain): bool
    {
        return $fountainRequest->provider_name() === $fountain->provider_name()?->getValue()
            && $fountainRequest->provider_id() === $fountain->provider_id()?->getValue();
    }

    private static function isRequestNewer(CreateOrUpdateFountainRequest $fountainRequest, Fountain $fountain): bool
    {
        return $fountainRequest->provider_updated_at() > $fountain->provider_updated_at()?->getValue();
    }

    private function mergeRequest(CreateOrUpdateFountainRequest $fountainRequest, Fountain $fountain): UpdateFountainRequest
    {
        $isRequestNewer = self::isRequestNewer($fountainRequest, $fountain);

        $existingFountainRequest = $this->fountainToUpdateRequest($fountain);

        $recent = $isRequestNewer ? $fountainRequest : $existingFountainRequest;
        $other = $isRequestNewer ? $existingFountainRequest : $fountainRequest;

        return new UpdateFountainRequest(
            $fountain->id()->getValue(),
            $recent->lat(),
            $recent->long(),
            $recent->name() ?? $other->name(),
            $recent->type() ?? $other->type(),
            $recent->picture() ?? $other->picture(),
            $recent->description() ?? $other->description(),
            $recent->operational_status() ?? $other->operational_status(),
            $recent->safe_water() ?? $other->safe_water(),
            $recent->legal_water() ?? $other->legal_water(),
            $recent->access_bottles() ?? $other->access_bottles(),
            $recent->access_pets() ?? $other->access_pets(),
            $recent->access_wheelchair() ?? $other->access_wheelchair(),
            $recent->provider_name(),
            $recent->provider_id(),
            $recent->user_id(),
            $recent->provider_updated_at()
        );
    }

    private function fountainToUpdateRequest(Fountain $fountain): UpdateFountainRequest
    {
        return new UpdateFountainRequest(
            $fountain->id()->getValue(),
            $fountain->lat()->getValue(),
            $fountain->long()->getValue(),
            $fountain->name()?->getValue(),
            $fountain->type()?->value,
            $fountain->picture()?->getValue(),
            $fountain->description()?->getValue(),
            $fountain->operational_status()?->getValue(),
            $fountain->safe_water()?->value,
            $fountain->legal_water()?->value,
            $fountain->access_bottles()?->getValue(),
            $fountain->access_pets()?->getValue(),
            $fountain->access_wheelchair()?->getValue(),
            $fountain->provider_name()?->getValue(),
            $fountain->provider_id()?->getValue(),
            $fountain->user_id()?->getValue(),
            $fountain->provider_updated_at()?->getValue()
        );
    }
}