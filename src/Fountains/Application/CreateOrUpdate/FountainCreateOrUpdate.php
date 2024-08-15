<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\Create\DTO\FountainRequest;
use App\Fountains\Application\Create\Factory\CreateFountainFactory;
use App\Fountains\Application\Create\FountainCreator;
use App\Fountains\Application\CreateOrUpdate\DTO\CreateOrUpdateFountainRequest;
use App\Fountains\Application\Update\FountainUpdater;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Fountains\Domain\ValueObject\FountainProviderId;

abstract class FountainCreateOrUpdate
{
    public function __construct(
        protected FountainRepository $fountainRepository,
        private FountainCreator $fountainCreator
    ) { }

    protected function queue(CreateOrUpdateFountainRequest $fountainRequest): Fountain
    {
        $fountain = $this->find($fountainRequest);

        $fountain = $fountain ? $this->updateFountain($fountain, $fountainRequest) : $this->createFountain($fountainRequest);

        $this->fountainRepository->persist($fountain);

        return $fountain;
    }

    protected function find(CreateOrUpdateFountainRequest $fountainRequest): ?Fountain
    {
        // Find if there is an existing fountain in the database
        $fountainProvider = $this->findByProvider(
            new FountainProviderName($fountainRequest->provider_name()),
            new FountainProviderId($fountainRequest->provider_id())
        );

        if ($fountainProvider !== null) {
            // Same provider node to update
            return $fountainProvider;
        }

        $fountainLocation = $this->findByLocation(
            new FountainLat($fountainRequest->lat()),
            new FountainLong($fountainRequest->long())
        );

        // If there is a fountain with different provider node but with same location, then the node is duplicated
        // Update existing fountain with the same location
        return $fountainLocation;
    }

    protected function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain
    {
        return $this->fountainRepository->findByLocation($lat, $long);
    }

    protected function findByProvider(FountainProviderName $provider, FountainProviderId $providerId): ?Fountain
    {
        return $this->fountainRepository->findByProvider($provider, $providerId);
    }

    private function createFountain(FountainRequest $fountainRequest): Fountain
    {
        return CreateFountainFactory::createWithId($fountainRequest, FountainId::generate());
    }

    private function updateFountain(Fountain $fountain, FountainRequest $fountainRequest): Fountain
    {
        $existingFountainRequest = CreateOrUpdateFountainRequestFactory::fromFountain($fountain);

        // Combine attributes of existing fountain with the update request
        $fountainRequest = $this->mergeRequest($existingFountainRequest, $fountainRequest);

        /*
        * Handle case when $fountain updates its location (different lat/long than $fountainRequest)
        * It may collide with another fountain node in the new location ($fountainLocation)
        * In that case, merge and update $fountainLocation with $fountainRequest, then delete $fountain with old location
        */
        if ($fountain->lat()->getValue() !== $fountainRequest->lat() || $fountain->long()->getValue() !== $fountainRequest->long())
        {
            $fountainLocation = $this->findByLocation(
                new FountainLat($fountainRequest->lat()),
                new FountainLong($fountainRequest->long())
            );

            if ($fountainLocation !== null) {
                $existingFountainRequest = CreateOrUpdateFountainRequestFactory::fromFountain($fountainLocation);
                $fountainRequest = $this->mergeRequest($existingFountainRequest, $fountainRequest);
                $this->fountainRepository->delete($fountain);
                $fountain = $fountainLocation;
            }
        }

        // Update fountain node with the merged update request
        FountainUpdater::update($fountain, $fountainRequest);

        return $fountain;
    }

    private function mergeRequest(FountainRequest $fountainRequestCurrent, FountainRequest $fountainRequestOther): FountainRequest
    {
        $isRequestNewer = self::isRequestNewer($fountainRequestOther, $fountainRequestCurrent);

        $recent = $isRequestNewer ? $fountainRequestOther : $fountainRequestCurrent;
        $other = $isRequestNewer ? $fountainRequestCurrent : $fountainRequestOther;

        return CreateOrUpdateFountainRequestFactory::fromFountainRequest($recent, $other);
    }

    private static function isRequestNewer(FountainRequest $fountainRequest1, FountainRequest $fountainRequest2): bool
    {
        return $fountainRequest1->provider_updated_at() >= $fountainRequest2->provider_updated_at();
    }
}