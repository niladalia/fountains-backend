<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\Create\CreateFountainFactory;
use App\Fountains\Application\CreateOrUpdate\DTO\CreateOrUpdateFountainRequest;
use App\Fountains\Application\Create\DTO\FountainRequest;
use App\Fountains\Application\Create\FountainCreator;
use App\Fountains\Application\Update\FountainUpdater;
use App\Fountains\Application\Update\UpdateFountainRequestFactory;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

abstract class FountainCreateOrUpdate
{
    public function __construct(
        protected FountainRepository $fountainRepository,
        private FountainCreator $fountainCreator
    ) { }

    protected function queue(CreateOrUpdateFountainRequest $fountainRequest): Fountain
    {
        $fountain = $this->findByLocation(
            new FountainLat($fountainRequest->lat()),
            new FountainLong($fountainRequest->long())
        );

        if ($fountain) {
            $this->updateFountain($fountain, $fountainRequest);
        } else {
            $fountain = $this->createFountain($fountainRequest);
        }

        $this->fountainRepository->persist($fountain);

        return $fountain;
    }

    protected function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain
    {
        return $this->fountainRepository->findByLocation($lat, $long);
    }

    private function createFountain(FountainRequest $fountainRequest): Fountain
    {
        return CreateFountainFactory::createWithId($fountainRequest, FountainId::generate());
    }

    private function updateFountain(Fountain $fountain, FountainRequest $fountainRequest)
    {
        $fountainRequest = $this->mergeRequest($fountain, $fountainRequest);
        FountainUpdater::update($fountain, $fountainRequest);
    }

    private function mergeRequest(Fountain $fountain, FountainRequest $fountainRequest): FountainRequest
    {
        $existingFountainRequest = UpdateFountainRequestFactory::fromFountain($fountain);

        $isRequestNewer = self::isRequestNewer($fountainRequest, $fountain);

        $recent = $isRequestNewer ? $fountainRequest : $existingFountainRequest;
        $other = $isRequestNewer ? $existingFountainRequest : $fountainRequest;

        return UpdateFountainRequestFactory::fromFountainRequest(
            $fountain->id()->getValue(),
            $recent,
            $other
        );
    }

    private static function isRequestNewer(FountainRequest $fountainRequest, Fountain $fountain): bool
    {
        return $fountainRequest->provider_updated_at() >= $fountain->provider_updated_at()->getValue();
    }
}