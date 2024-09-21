<?php

namespace App\Fountains\Application\Update;

use App\Fountains\Application\Find\FountainFinder;
use App\Fountains\Application\Create\DTO\FountainRequest;
use App\Fountains\Application\Update\DTO\UpdateFountainRequest;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
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

class FountainUpdater
{
    public function __construct(
        private FountainFinder $fountainFinder
    ) { }

    public function __invoke(UpdateFountainRequest $fountainRequest, ?Fountain $fountain = null)
    {
        if (!$fountain) {
            $fountain = $this->fountainFinder->__invoke(
                FountainId::fromString($fountainRequest->id())
            );
        }

        $this->update($fountain, $fountainRequest);
    }

    private function update(Fountain $fountain, FountainRequest $fountainRequest)
    {
        $fountain->update(
            new FountainLat($fountainRequest->lat()),
            new FountainLong($fountainRequest->long()),
            new FountainName($fountainRequest->name()),
            FountainType::fromString($fountainRequest->type()),
            new FountainPicture($fountainRequest->picture()),
            new FountainDescription($fountainRequest->description()),
            new FountainOperationalStatus($fountainRequest->operational_status()),
            FountainSafeWater::fromString($fountainRequest->safe_water()),
            FountainLegalWater::fromString($fountainRequest->legal_water()),
            new FountainAccesBottles($fountainRequest->access_bottles()),
            new FountainAccesPets($fountainRequest->access_pets()),
            new FountainAccessWheelchair($fountainRequest->access_wheelchair()),
            FountainAccess::fromString($fountainRequest->access()),
            new FountainFee($fountainRequest->fee()),
            new FountainAddress($fountainRequest->address()),
            new FountainWebsite($fountainRequest->website()),
            new FountainProviderName($fountainRequest->provider_name()),
            new FountainProviderId($fountainRequest->provider_id()),
            new FountainProviderUpdatedAt($fountainRequest->provider_updated_at()),
            new FountainProviderUrl($fountainRequest->provider_url()),
            new FountainUserId($fountainRequest->user_id())
        );
    }
}