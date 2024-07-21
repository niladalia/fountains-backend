<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\Create\FountainCreatorQueue;
use App\Fountains\Application\Update\FountainUpdaterQueue;
use App\Fountains\Application\Update\DTO\UpdateFountainRequest;
use App\Fountains\Application\Create\DTO\FountainRequest;
use App\Fountains\Application\Create\DTO\CreateFountainRequest;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

abstract class FountainCreateOrUpdate
{
    public function __construct(
        protected FountainRepository     $fountainRepository,
        private FountainCreatorQueue     $fountainCreator,
        private FountainUpdaterQueue     $fountainUpdater
    ) {}

    protected function queue(CreateOrUpdateFountainRequest $fountainRequest): Fountain
    {
        $fountain = $this->findByLocation(
            new FountainLat($fountainRequest->lat()),
            new FountainLong($fountainRequest->long())
        );

        if ($fountain) {
            $fountain = $this->mergeFountain($fountainRequest, $fountain);
        } else {
            $fountain = $this->createFountain($fountainRequest);
        }

        return $fountain;
    }

    protected function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain
    {
        return $this->fountainRepository->findByLocation($lat, $long);
    }

    private function createFountain(CreateOrUpdateFountainRequest $fountainRequest): Fountain
    {
        return $this->fountainCreator->__invoke(
            new CreateFountainRequest(
                FountainId::generate()->getValue(),
                $fountainRequest->lat(),
                $fountainRequest->long(),
                $fountainRequest->name(),
                $fountainRequest->type(),
                $fountainRequest->picture(),
                $fountainRequest->description(),
                $fountainRequest->operational_status(),
                $fountainRequest->safe_water(),
                $fountainRequest->legal_water(),
                $fountainRequest->access_bottles(),
                $fountainRequest->access_pets(),
                $fountainRequest->access_wheelchair(),
                $fountainRequest->provider_name(),
                $fountainRequest->provider_id(),
                $fountainRequest->user_id(),
                $fountainRequest->provider_updated_at()
            )
        );
    }

    private function mergeFountain(FountainRequest $fountainRequest, Fountain $fountain): Fountain
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

    private function updateFountain(FountainRequest $fountainRequest, Fountain $fountain): Fountain
    {
        $updateFountainRequest = UpdateFountainRequestFactory::fromFountainRequest($fountain->id()->getValue(), $fountainRequest);
        return $this->updateFountainFromRequest($updateFountainRequest, $fountain);
    }

    private function updateFountainFromRequest(UpdateFountainRequest $updateFountainRequest, Fountain $fountain): Fountain
    {
        return $this->fountainUpdater->__invoke($updateFountainRequest, $fountain);
    }

    private function mergeRequest(FountainRequest $fountainRequest, Fountain $fountain): UpdateFountainRequest
    {
        $isRequestNewer = self::isRequestNewer($fountainRequest, $fountain);

        $existingFountainRequest = UpdateFountainRequestFactory::fromFountain($fountain);

        $recent = $isRequestNewer ? $fountainRequest : $existingFountainRequest;
        $other = $isRequestNewer ? $existingFountainRequest : $fountainRequest;

        return UpdateFountainRequestFactory::fromFountainRequestOrDefault($fountain->id()->getValue(), $recent, $other);
    }

    private static function isSameProviderFountain(FountainRequest $fountainRequest, Fountain $fountain): bool
    {
        return $fountainRequest->provider_name() === $fountain->provider_name()?->getValue()
            && $fountainRequest->provider_id() === $fountain->provider_id()?->getValue();
    }

    private static function isRequestNewer(FountainRequest $fountainRequest, Fountain $fountain): bool
    {
        return $fountainRequest->provider_updated_at() > $fountain->provider_updated_at()?->getValue();
    }
}