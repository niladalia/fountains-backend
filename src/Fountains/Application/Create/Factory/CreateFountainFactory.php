<?php

namespace App\Fountains\Application\Create\Factory;

use App\Fountains\Application\Create\DTO\CreateFountainRequest;
use App\Fountains\Application\Create\DTO\FountainRequest;
use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\ValueObject\FountainAccesBottles;
use App\Fountains\Domain\ValueObject\FountainAccesPets;
use App\Fountains\Domain\ValueObject\FountainAccess;
use App\Fountains\Domain\ValueObject\FountainAccessWheelchair;
use App\Fountains\Domain\ValueObject\FountainAddress;
use App\Fountains\Domain\ValueObject\FountainDescription;
use App\Fountains\Domain\ValueObject\FountainFee;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLegalWater;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainName;
use App\Fountains\Domain\ValueObject\FountainOperationalStatus;
use App\Fountains\Domain\ValueObject\FountainPicture;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Fountains\Domain\ValueObject\FountainProviderUpdatedAt;
use App\Fountains\Domain\ValueObject\FountainProviderUrl;
use App\Fountains\Domain\ValueObject\FountainSafeWater;
use App\Fountains\Domain\ValueObject\FountainType;
use App\Fountains\Domain\ValueObject\FountainWebsite;
use App\Users\Domain\User;

abstract class CreateFountainFactory
{
    public static function create(CreateFountainRequest $fountainRequest, ?User $user = null): Fountain
    {
        return self::createFountain(
            $fountainRequest,
            $user,
        );
    }

    private static function createFountain(
        FountainRequest $fountainRequest,
        ?User $user = null,
    ): Fountain {
        return Fountain::create(
            new FountainId($fountainRequest->id()),
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
            $user,
        );
    }
}
