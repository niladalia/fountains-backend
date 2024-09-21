<?php

namespace App\Tests\Fountains\Application\Create\DTO;

use App\Fountains\Application\Update\DTO\UpdateFountainRequest;
use App\Tests\Fountains\Domain\ValueObject\FountainAccesBottlesMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAccesPetsMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAccessMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAccessWheelchairMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAddressMother;
use App\Tests\Fountains\Domain\ValueObject\FountainDescriptionMother;
use App\Tests\Fountains\Domain\ValueObject\FountainFeeMother;
use App\Tests\Fountains\Domain\ValueObject\FountainIdMother;
use App\Tests\Fountains\Domain\ValueObject\FountainLatMother;
use App\Tests\Fountains\Domain\ValueObject\FountainLegalWaterMother;
use App\Tests\Fountains\Domain\ValueObject\FountainLongMother;
use App\Tests\Fountains\Domain\ValueObject\FountainNameMother;
use App\Tests\Fountains\Domain\ValueObject\FountainOperationalStatusMother;
use App\Tests\Fountains\Domain\ValueObject\FountainPictureMother;
use App\Tests\Fountains\Domain\ValueObject\FountainProviderIdMother;
use App\Tests\Fountains\Domain\ValueObject\FountainProviderNameMother;
use App\Tests\Fountains\Domain\ValueObject\FountainProviderUpdatedAtMother;
use App\Tests\Fountains\Domain\ValueObject\FountainProviderUrlMother;
use App\Tests\Fountains\Domain\ValueObject\FountainSafeWaterMother;
use App\Tests\Fountains\Domain\ValueObject\FountainTypeMother;
use App\Tests\Fountains\Domain\ValueObject\FountainUserIdMother;
use App\Tests\Fountains\Domain\ValueObject\FountainWebsiteMother;
use DateTime;

class UpdateFountainRequestMother
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
        string $access = null,
        bool $fee = null,
        string $address = null,
        string $website = null,
        string $provider_name = null,
        string $provider_id = null,
        DateTime $provider_updated_at = null,
        string $provider_url = null,
        string $user_id = null
    ): UpdateFountainRequest {
        return new UpdateFountainRequest(
            $id ?? FountainIdMother::create()->getValue(),
            $lat ?? FountainLatMother::create()->getValue(),
            $long ?? FountainLongMother::create()->getValue(),
            $name ?? FountainNameMother::create()->getValue(),
            $type ?? FountainTypeMother::create()->getValue(),
            $picture ?? FountainPictureMother::create()->getValue(),
            $description ?? FountainDescriptionMother::create()->getValue(),
            $operational_status ?? FountainOperationalStatusMother::create()->getValue(),
            $safe_water ?? FountainSafeWaterMother::create()->getValue(),
            $legal_water ?? FountainLegalWaterMother::create()->getValue(),
            $access_bottles ?? FountainAccesBottlesMother::create()->getValue(),
            $access_pets ?? FountainAccesPetsMother::create()->getValue(),
            $access_wheelchair ?? FountainAccessWheelchairMother::create()->getValue(),
            $access ?? FountainAccessMother::create()->getValue(),
            $fee ??  FountainFeeMother::create()->getValue(),
            $address ??  FountainAddressMother::create()->getValue(),
            $website ??  FountainWebsiteMother::create()->getValue(),
            $provider_name ?? FountainProviderNameMother::create()->getValue(),
            $provider_id ?? FountainProviderIdMother::create()->getValue(),
            $provider_updated_at ?? FountainProviderUpdatedAtMother::create()->getValue(),
            $provider_url ?? FountainProviderUrlMother::create()->getValue(),
            $user_id ?? FountainUserIdMother::create()->getValue()
        );
    }
}
