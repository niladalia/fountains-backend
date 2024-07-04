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

        /*
            lat,long ?
            No: Insert new
            Yes:
            same provider_name,provider_id ?
              yes: If provider_updated_at new > old: Update all fields (replace: recent ?? null)
              no: Update non-null fields (patch: recent ?? other). new provider_updated_at >= old ? recent=new, other=old : recent=old, other=new
            provider_updated_at = recent
            provider_name, provider_id = new
         */

        $fountain = $this->fountainFinderByProviderId->__invoke(
            new FountainProviderName($fountainRequest->provider_name()),
            new FountainProviderId($fountainRequest->provider_id())
        );

        if ($fountain) {
            $updateFountainRequest = CreateOrUpdateFountainRequestFactory::toUpdateFountainRequest(
                $fountainRequest,
                $fountain->id()
            );
            $this->fountainUpdater->__invoke($updateFountainRequest, $fountain);
        } else {
            $createFountainRequest = CreateOrUpdateFountainRequestFactory::toCreateFountainRequest(
                $fountainRequest
            );
            $this->fountainCreator->__invoke($createFountainRequest);
        }

    }
}