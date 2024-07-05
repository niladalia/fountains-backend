<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\Find\FountainFinderByLocation;
use App\Fountains\Application\Create\FountainCreator;
use App\Fountains\Application\Update\FountainUpdater;
use App\Fountains\Application\Update\UpdateFountainRequest;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\Fountain;

class FountainCreateOrUpdate
{
    public function __construct(
        private FountainFinderByLocation $fountainFinderByLocation,
        private FountainCreator          $fountainCreator,
        private FountainUpdater          $fountainUpdater
    ) {}

    public function __invoke(CreateOrUpdateFountainRequest $fountainRequest)
    {
        $fountain = $this->fountainFinderByLocation->__invoke(
            new FountainLat($fountainRequest->lat()),
            new FountainLong($fountainRequest->long())
        );

        if ($fountain) {
            $this->mergeFountain($fountainRequest, $fountain);
        } else {
            $this->createFountain($fountainRequest);
        }
    }

    private function createFountain(CreateOrUpdateFountainRequest $fountainRequest)
    {
        $createFountainRequest = CreateOrUpdateFountainRequestFactory::toCreateFountainRequest(
            $fountainRequest
        );
        $this->fountainCreator->__invoke($createFountainRequest);
    }

    private function mergeFountain(CreateOrUpdateFountainRequest $fountainRequest, Fountain $fountain)
    {
        if (self::isSameProviderFountain($fountainRequest, $fountain)) {
            if (self::isRequestNewer($fountainRequest, $fountain)) {
                $this->updateFountain($fountainRequest, $fountain);
            }
        } else {
            $updateFountainRequest = $this->mergeRequest($fountainRequest, $fountain);
            $this->updateFountainFromRequest($updateFountainRequest, $fountain);
        }
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

        $existingFountainRequest = $this->fountainToRequest($fountain);

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

    private function fountainToRequest(Fountain $fountain): UpdateFountainRequest
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

    private function updateFountain(CreateOrUpdateFountainRequest $fountainRequest, Fountain $fountain)
    {
        $updateFountainRequest = CreateOrUpdateFountainRequestFactory::toUpdateFountainRequest(
            $fountainRequest,
            $fountain->id()->getValue()
        );
        $this->updateFountainFromRequest($updateFountainRequest, $fountain);
    }

    private function updateFountainFromRequest(UpdateFountainRequest $updateFountainRequest, Fountain $fountain)
    {
        $this->fountainUpdater->__invoke($updateFountainRequest, $fountain);
    }
}