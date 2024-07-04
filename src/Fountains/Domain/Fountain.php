<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainAccesBottles;
use App\Fountains\Domain\ValueObject\FountainAccesPets;
use App\Fountains\Domain\ValueObject\FountainAccessWheelchair;
use App\Fountains\Domain\ValueObject\FountainCreatedAt;
use App\Fountains\Domain\ValueObject\FountainDescription;
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
use App\Fountains\Domain\ValueObject\FountainSafeWater;
use App\Fountains\Domain\ValueObject\FountainType;
use App\Fountains\Domain\ValueObject\FountainUpdatedAt;
use App\Fountains\Domain\ValueObject\FountainUserId;
use App\Shared\Domain\Utils\DateTimeUtils;

class Fountain
{
    private ?FountainCreatedAt $created_at = null;
    private ?FountainUpdatedAt  $updated_at = null;

    public function __construct(
        private FountainId                 $id,
        private FountainLat                $lat,
        private FountainLong               $long,
        private ?FountainName              $name,
        private ?FountainType              $fountain_type,
        private ?FountainPicture           $picture,
        private ?FountainDescription       $description,
        private ?FountainOperationalStatus $operational_status,
        private ?FountainSafeWater         $safe_water,
        private ?FountainLegalWater        $legal_water,
        private ?FountainAccesBottles      $access_bottles,
        private ?FountainAccesPets         $access_pets,
        private ?FountainAccessWheelchair  $access_wheelchair,
        private ?FountainProviderName      $provider_name,
        private ?FountainProviderId        $provider_id,
        private ?FountainUserId            $user_id,
        private ?FountainProviderUpdatedAt $provider_updated_at
    ) {
        $now = DateTimeUtils::now();
        $this->created_at = new FountainCreatedAt($now);
        $this->updated_at = new FountainUpdatedAt($now);
    }

    public static function create(
        FountainId                 $id,
        FountainLat                $lat,
        FountainLong               $long,
        ?FountainName              $name,
        ?FountainType              $fountain_type,
        ?FountainPicture           $picture,
        ?FountainDescription       $description,
        ?FountainOperationalStatus $operational_status,
        ?FountainSafeWater         $safe_water,
        ?FountainLegalWater        $legal_water,
        ?FountainAccesBottles      $access_bottles,
        ?FountainAccesPets         $access_pets,
        ?FountainAccessWheelchair  $access_wheelchair,
        ?FountainProviderName      $provider_name,
        ?FountainProviderId        $provider_id,
        ?FountainUserId            $user_id,
        ?FountainProviderUpdatedAt $provider_updated_at

    ): self {
        return new self(
            $id,
            $lat,
            $long,
            $name,
            $fountain_type,
            $picture,
            $description,
            $operational_status,
            $safe_water,
            $legal_water,
            $access_bottles,
            $access_pets,
            $access_wheelchair,
            $provider_name,
            $provider_id,
            $user_id,
            $provider_updated_at
        );
    }

    public function update(
        FountainLat                $lat,
        FountainLong               $long,
        ?FountainName              $name,
        ?FountainType              $fountain_type,
        ?FountainPicture           $picture,
        ?FountainDescription       $description,
        ?FountainOperationalStatus $operational_status,
        ?FountainSafeWater         $safe_water,
        ?FountainLegalWater        $legal_water,
        ?FountainAccesBottles      $access_bottles,
        ?FountainAccesPets         $access_pets,
        ?FountainAccessWheelchair  $access_wheelchair,
        ?FountainProviderName      $provider_name,
        ?FountainProviderId        $provider_id,
        ?FountainUserId            $user_id,
        ?FountainProviderUpdatedAt $provider_updated_at,
        ?FountainUpdatedAt         $updated_at

    ): void {
        $this->updateName($name);
        $this->updateLat($lat);
        $this->updateLong($long);
        $this->updatePicture($picture);
        $this->updateType($fountain_type);
        $this->updateDescription($description);
        $this->updateOperationalStatus($operational_status);
        $this->updateSafeWater($safe_water);
        $this->updateLegalWater($legal_water);
        $this->updateAccesBottles($access_bottles);
        $this->updateAccesPets($access_pets);
        $this->updateAccessWheelchair($access_wheelchair);
        $this->updateProviderName($provider_name);
        $this->updateProviderId($provider_id);
        $this->updateUserId($user_id);
        $this->updateUpdatedAt($updated_at);
        $this->updateProviderUpdatedAt($provider_updated_at);
    }

    public function id(): ?FountainId
    {
        return $this->id;
    }

    public function name(): ?FountainName
    {
        return $this->name;
    }

    public function updateName(?FountainName $name): void
    {
        $this->name = $name;
    }

    public function lat(): FountainLat
    {
        return $this->lat;
    }

    public function updateLat(FountainLat $lat): void
    {
        $this->lat = $lat;
    }

    public function long(): FountainLong
    {
        return $this->long;
    }

    public function updateLong(FountainLong $long): void
    {
        $this->long = $long;
    }

    public function picture(): ?FountainPicture
    {
        return $this->picture;
    }

    public function updatePicture(?FountainPicture $picture): void
    {
        $this->picture = $picture;
    }

    public function type(): ?FountainType
    {
        return $this->fountain_type;
    }

    public function updateType(?FountainType $fountain_type): void
    {
        $this->fountain_type = $fountain_type;
    }

    public function description(): ?FountainDescription
    {
        return $this->description;
    }

    public function updateDescription(?FountainDescription $description): void
    {
        $this->description = $description;
    }

    public function operational_status(): ?FountainOperationalStatus
    {
        return $this->operational_status;
    }

    public function updateOperationalStatus(?FountainOperationalStatus $operational_status): void
    {
        $this->operational_status = $operational_status;
    }

    public function safe_water(): FountainSafeWater
    {
        return $this->safe_water;
    }

    public function updateSafeWater(FountainSafeWater $safe_water): void
    {
        $this->safe_water = $safe_water;
    }

    public function legal_water(): FountainLegalWater
    {
        return $this->legal_water;
    }

    public function updateLegalWater(FountainLegalWater $legal_water): void
    {
        $this->legal_water = $legal_water;
    }

    public function access_bottles(): ?FountainAccesBottles
    {
        return $this->access_bottles;
    }

    public function updateAccesBottles(?FountainAccesBottles $access_bottles): void
    {
        $this->access_bottles = $access_bottles;
    }

    public function access_pets(): ?FountainAccesPets
    {
        return $this->access_pets;
    }

    public function updateAccesPets(?FountainAccesPets $access_pets): void
    {
        $this->access_pets = $access_pets;
    }

    public function access_wheelchair(): ?FountainAccessWheelchair
    {
        return $this->access_wheelchair;
    }

    public function updateAccessWheelchair(?FountainAccessWheelchair $access_wheelchair): void
    {
        $this->access_wheelchair = $access_wheelchair;
    }

    public function provider_name(): ?FountainProviderName
    {
        return $this->provider_name;
    }

    public function updateProviderName(?FountainProviderName $provider_name): void
    {
        $this->provider_name = $provider_name;
    }

    public function provider_id(): ?FountainProviderId
    {
        return $this->provider_id;
    }

    public function updateProviderId(?FountainProviderId $provider_id): void
    {
        $this->provider_id = $provider_id;
    }

    public function user_id(): ?FountainUserId
    {
        return $this->user_id;
    }

    public function updateUserId(?FountainUserId $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function updated_at(): ?FountainUpdatedAt
    {
        return $this->updated_at;
    }

    public function updateUpdatedAt(?FountainUpdatedAt $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function provider_updated_at(): ?FountainProviderUpdatedAt
    {
        return $this->provider_updated_at;
    }

    public function updateProviderUpdatedAt(?FountainProviderUpdatedAt $provider_updated_at): void
    {
        $this->provider_updated_at = $provider_updated_at;
    }

    public function created_at(): ?FountainCreatedAt
    {
        return $this->created_at;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id()->getValue(),
            'name' => $this->name()->getValue(),
            'lat' => $this->lat()->getValue(),
            'long' => $this->long()->getValue(),
            'picture' => $this->picture()->getValue(),
            'type' => $this->type()->value,
            'description' => $this->description()->getValue(),
            'operational_status' => $this->operational_status()->getValue(),
            'safe_water' => $this->safe_water()->value,
            'legal_water' => $this->legal_water()->value,
            'access_bottles' => $this->access_bottles()->getValue(),
            'access_pets' => $this->access_pets()->getValue(),
            'access_wheelchair' => $this->access_wheelchair()->getValue(),
            'provider_name' => $this->provider_name()->getValue(),
            'provider_id' => $this->provider_id()->getValue(),
            'user_id' => $this->user_id()->getValue(),
            'updated_at' => $this->updated_at()->formatISO(),
            'provider_updated_at' => $this->provider_updated_at()->formatISO(),
            'created_at' => $this->created_at()->formatISO()
        ];
    }

}
