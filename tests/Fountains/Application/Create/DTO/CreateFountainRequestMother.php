<?php

namespace App\Tests\Fountains\Application\Create\DTO;

use App\Fountains\Application\Create\DTO\CreateFountainRequest;

use DateTime;

class CreateFountainRequestMother
{
    public static function create(
        string $id = null,
        float $lat = null,
        float $long = null,
        string $name = null,
        string $type = null,
        string $picture = null,
        string $description = null,
        bool $operational_status = null,
        string $safe_water = null,
        string $legal_water = null,
        bool $access_bottles = null,
        bool $access_pets = null,
        bool $access_wheelchair = null,
        string $provider_name = null,
        string $provider_id = null,
        string $user_id = null,
        DateTime $provider_updated_at = null
    ): CreateFountainRequest {
        return new CreateFountainRequest(
            $id ?? FountainId::create(),
            $lat ?? new FountainLat::create()->getValue(),
            $long ?? new FountainLong::create()->getValue(),
            $name ?? new FountainName::create()->getValue(),
            $type ?? FountainType::create(),
            $picture ?? new FountainPicture::create()->getValue(),
            $description ?? new FountainDescription::create()->getValue(),
            $operational_status ?? new FountainOperationalStatus::create()->getValue(),
            $safe_water ?? FountainSafeWater::create(),
            $legal_water ?? FountainLegalWater::create(),
            $access_bottles ?? new FountainAccesBottles::create()->getValue(),
            $access_pets ?? new FountainAccesPets::create()->getValue(),
            $access_wheelchair ?? new FountainAccessWheelchair::create()->getValue(),
            $provider_name ?? new FountainProviderName::create()->getValue(),
            $provider_id ?? new FountainProviderId::create()->getValue(),
            $user_id ?? new FountainUserId::create()->getValue(),
            $provider_updated_a ?? new FountainProviderUpdatedAt::create()->getValue())
        );
    }
}
