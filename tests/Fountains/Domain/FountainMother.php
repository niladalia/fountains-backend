<?php

namespace App\Tests\Fountains\Domain;

use App\Fountains\Application\Create\DTO\CreateFountainRequest;
use App\Fountains\Domain\Fountain;
use App\Tests\Fountains\Domain\ValueObject\FountainAccesBottlesMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAccesPetsMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAccessMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAccessWheelchairMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAddressMother;
use App\Tests\Fountains\Domain\ValueObject\FountainCreatedAtMother;
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
use App\Tests\Fountains\Domain\ValueObject\FountainUpdatedAtMother;
use App\Tests\Fountains\Domain\ValueObject\FountainUserIdMother;
use App\Tests\Fountains\Domain\ValueObject\FountainWebsiteMother;


use App\Fountains\Domain\ValueObject\FountainAccesBottles;
use App\Fountains\Domain\ValueObject\FountainAccesPets;
use App\Fountains\Domain\ValueObject\FountainAccess;
use App\Fountains\Domain\ValueObject\FountainAccessWheelchair;
use App\Fountains\Domain\ValueObject\FountainAddress;
use App\Fountains\Domain\ValueObject\FountainCreatedAt;
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
use App\Fountains\Domain\ValueObject\FountainUpdatedAt;
use App\Fountains\Domain\ValueObject\FountainUserId;
use App\Fountains\Domain\ValueObject\FountainWebsite;
class FountainMother
{
    public static function create(
         ?FountainId                $id,
         ?FountainLat               $lat,
         ?FountainLong              $long,
         ?FountainName              $name,
         ?FountainType              $type,
         ?FountainPicture           $picture,
         ?FountainDescription       $description,
         ?FountainOperationalStatus $operational_status,
         ?FountainSafeWater         $safe_water,
         ?FountainLegalWater        $legal_water,
         ?FountainAccesBottles      $access_bottles,
         ?FountainAccesPets         $access_pets,
         ?FountainAccessWheelchair  $access_wheelchair,
         ?FountainAccess            $access,
         ?FountainFee               $fee,
         ?FountainAddress           $address,
         ?FountainWebsite           $website,
         ?FountainProviderName      $provider_name,
         ?FountainProviderId        $provider_id,
         ?FountainProviderUpdatedAt $provider_updated_at,
         ?FountainProviderUrl       $provider_url,
         ?FountainUserId            $user_id,
         ?FountainCreatedAt         $created_at,
         ?FountainUpdatedAt         $updated_at
    ): Fountain {
        return new Fountain(
            $id ?? FountainIdMother::create(),
            $lat ?? FountainLatMother::create(),
            $long ?? FountainLongMother::create(),
            $name ?? FountainNameMother::create(),
            $type ?? FountainTypeMother::create(),
            $picture ?? FountainPictureMother::create(),
            $description ?? FountainDescriptionMother::create(),
            $operational_status ?? FountainOperationalStatusMother::create(),
            $safe_water ?? FountainSafeWaterMother::create(),
            $legal_water ?? FountainLegalWaterMother::create(),
            $access_bottles ?? FountainAccesBottlesMother::create(),
            $access_pets ?? FountainAccesPetsMother::create(),
            $access_wheelchair ?? FountainAccessWheelchairMother::create(),
            $access ?? FountainAccessMother::create(),
            $fee ?? FountainFeeMother::create(),
            $address ?? FountainAddressMother::create(),
            $website ?? FountainWebsiteMother::create(),
            $provider_name ?? FountainProviderNameMother::create(),
            $provider_id ?? FountainProviderIdMother::create(),
            $provider_updated_at ?? FountainProviderUpdatedAtMother::create(),
            $provider_url ?? FountainProviderUrlMother::create(),
            $user_id ?? FountainUserIdMother::create(),
            $created_at ?? FountainCreatedAtMother::create(),
            $updated_at ?? FountainUpdatedAtMother::create()
        );
    }

    public static function fromRequest(CreateFountainRequest $request): Fountain
    {
        return self::create(
            FountainIdMother::create($request->id()),
            FountainLatMother::create($request->lat()),
            FountainLongMother::create($request->long()),
            FountainNameMother::create($request->name()),
            FountainTypeMother::create($request->type()),
            FountainPictureMother::create($request->picture()),
            FountainDescriptionMother::create($request->description()),
            FountainOperationalStatusMother::create($request->operational_status()),
            FountainSafeWaterMother::create($request->safe_water()),
            FountainLegalWaterMother::create($request->legal_water()),
            FountainAccesBottlesMother::create($request->access_bottles()),
            FountainAccesPetsMother::create($request->access_pets()),
            FountainAccessWheelchairMother::create($request->access_wheelchair()),
            FountainAccessMother::create($request->access()),
            FountainFeeMother::create($request->fee()),
            FountainAddressMother::create($request->address()),
            FountainWebsiteMother::create($request->website()),
            FountainProviderNameMother::create($request->provider_name()),
            FountainProviderIdMother::create($request->provider_id()),
            FountainProviderUpdatedAtMother::create($request->provider_updated_at()),
            FountainProviderUrlMother::create($request->provider_url()),
            FountainUserIdMother::create($request->user_id()),
            FountainCreatedAtMother::create(),
            FountainUpdatedAtMother::create()
        );
    }


}