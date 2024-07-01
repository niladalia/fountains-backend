<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\Create\FountainCreator;
use App\Fountains\Application\Find\FountainFinderByProvider;
use App\Fountains\Application\Update\FountainUpdater;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Shared\Domain\ValueObject\Uuid;

class FountainCreateOrUpdate
{
    public function __construct(
        private FountainFinderByProvider $fountainFinderByProviderId,
        private FountainCreator          $fountainCreator,
        private FountainUpdater          $fountainUpdater
    ) {}

    public function __invoke(CreateOrUpdateFountainRequest $fountainRequest){

        $fountain = $this->fountainFinderByProviderId->__invoke(
            new FountainProviderName($fountainRequest->provider_name()),
            new FountainProviderId($fountainRequest->provider_id())
        );

        if ($fountain) {
            $updateFountainRequest = CreateOrUpdateFountainRequestFactory::toUpdateFountainRequest($fountainRequest);
            $this->fountainUpdater->__invoke($updateFountainRequest, $fountain);
        } else {
            $createFountainRequest = CreateOrUpdateFountainRequestFactory::toCreateFountainRequest(
                $fountainRequest,
                Uuid::generate()->getValue()
            );
            $this->fountainCreator->__invoke($createFountainRequest);
        }

    }
}