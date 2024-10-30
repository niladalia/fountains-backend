<?php

namespace App\Tests\Fountains\Application\Create\DTO;

use App\Fountains\Application\Create\DTO\CreateFountainRequest;

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
class CreateFountainRequestMother
{
    public static function create(array $data = []): CreateFountainRequest {
        return new CreateFountainRequest(
            $data['id'] ?? FountainIdMother::create()->getValue(),
            $data['lat'] ?? FountainLatMother::create()->getValue(),
            $data['long'] ?? FountainLongMother::create()->getValue(),
            $data['name'] ?? FountainNameMother::create()->getValue(),
            $data['type'] ?? FountainTypeMother::create()->getValue(),
            $data['picture'] ?? FountainPictureMother::create()->getValue(),
            $data['description'] ?? FountainDescriptionMother::create()->getValue(),
            $data['operational_status'] ?? FountainOperationalStatusMother::create()->getValue(),
            $data['safe_water'] ?? FountainSafeWaterMother::create()->getValue(),
            $data['legal_water'] ?? FountainLegalWaterMother::create()->getValue(),
            $data['access_bottles'] ?? FountainAccesBottlesMother::create()->getValue(),
            $data['access_pets'] ?? FountainAccesPetsMother::create()->getValue(),
            $data['access_wheelchair'] ?? FountainAccessWheelchairMother::create()->getValue(),
            $data['access'] ?? FountainAccessMother::create()->getValue(),
            $data['fee'] ?? FountainFeeMother::create()->getValue(),
            $data['address'] ?? FountainAddressMother::create()->getValue(),
            $data['website'] ?? FountainWebsiteMother::create()->getValue(),
            $data['provider_name'] ?? FountainProviderNameMother::create()->getValue(),
            $data['provider_id'] ?? FountainProviderIdMother::create()->getValue(),
            $data['provider_updated_at'] ?? FountainProviderUpdatedAtMother::create()->getValue(),
            $data['provider_url'] ?? FountainProviderUrlMother::create()->getValue(),
            $data['user_id'] ?? FountainUserIdMother::create()->getValue()
        );
    }
}
