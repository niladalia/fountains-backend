<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\Create\FountainCreator;
use App\Fountains\Application\Find\FountainFinderByProviderId;
use App\Fountains\Application\Update\FountainUpdater;
use App\Fountains\Domain\ValueObject\FountainProviderId;

class FountainCreateOrUpdate
{
    public function __construct(
        private FountainFinderByProviderId $fountainFinderByProviderId,
        private FountainCreator $fountainCreator,
        private FountainUpdater $fountainUpdater
    ) {}

    public function __invoke(CreateOrUpdateFountainRequest $fountainRequest){

        $fountain = $this->fountainFinderByProviderId->__invoke(new FountainProviderId($fountainRequest->provider_id()));
        if ($fountain) {
            $updateFountainRequest = CreateOrUpdateFountainRequestFactory::toUpdateFountainRequest($fountainRequest);
            $this->fountainUpdater->__invoke($updateFountainRequest, $fountain);
        } else {
            $createFountainRequest = CreateOrUpdateFountainRequestFactory::toCreateFountainRequest($fountainRequest);
            $this->fountainCreator->__invoke($createFountainRequest);
        }

    }
}