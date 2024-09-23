<?php

namespace App\Fountains\Application\Update;

use App\Fountains\Application\Find\FountainFinder;
use App\Fountains\Application\Create\DTO\FountainRequest;
use App\Fountains\Application\Update\DTO\UpdateFountainRequest;
use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainName;
use App\Fountains\Domain\ValueObject\FountainType;
use App\Fountains\Domain\ValueObject\FountainDescription;
use App\Fountains\Domain\ValueObject\FountainPicture;
use App\Fountains\Domain\ValueObject\FountainOperationalStatus;
use App\Fountains\Domain\ValueObject\FountainSafeWater;
use App\Fountains\Domain\ValueObject\FountainLegalWater;
use App\Fountains\Domain\ValueObject\FountainAccesBottles;
use App\Fountains\Domain\ValueObject\FountainAccesPets;
use App\Fountains\Domain\ValueObject\FountainAccessWheelchair;
use App\Fountains\Domain\ValueObject\FountainAccess;
use App\Fountains\Domain\ValueObject\FountainFee;
use App\Fountains\Domain\ValueObject\FountainAddress;
use App\Fountains\Domain\ValueObject\FountainWebsite;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderUrl;
use App\Fountains\Domain\ValueObject\FountainProviderUpdatedAt;
use App\Fountains\Domain\ValueObject\FountainUserId;
use App\Shared\Domain\Utils\Uuid;

class FountainUpdater
{
    public function __construct(
        private FountainFinder $fountainFinder
    ) { }

    public function __invoke(UpdateFountainRequest $updateRequest)
    {
        $fountain = $this->fountainFinder->__invoke(
            FountainId::fromString($updateRequest->id())
        );

        $this->update($fountain, $updateRequest);
    }

    private function update(Fountain $fountain, UpdateFountainRequest $updateRequest)
    {
        $fountain->update(
            new FountainLat($updateRequest->lat()),
            new FountainLong($updateRequest->long()),
            new FountainName($updateRequest->name()),
            FountainType::fromString($updateRequest->type()),
            new FountainPicture($updateRequest->picture()),
            new FountainDescription($updateRequest->description()),
            new FountainOperationalStatus($updateRequest->operational_status()),
            FountainSafeWater::fromString($updateRequest->safe_water()),
            FountainLegalWater::fromString($updateRequest->legal_water()),
            new FountainAccesBottles($updateRequest->access_bottles()),
            new FountainAccesPets($updateRequest->access_pets()),
            new FountainAccessWheelchair($updateRequest->access_wheelchair()),
            FountainAccess::fromString($updateRequest->access()),
            new FountainFee($updateRequest->fee()),
            new FountainAddress($updateRequest->address()),
            new FountainWebsite($updateRequest->website()),
            new FountainProviderName($updateRequest->provider_name()),
            new FountainProviderId($updateRequest->provider_id()),
            new FountainProviderUpdatedAt($updateRequest->provider_updated_at()),
            new FountainProviderUrl($updateRequest->provider_url()),
            new FountainUserId($updateRequest->user_id() ? Uuid::fromString($updateRequest->user_id()) : null)
        );
    }
}