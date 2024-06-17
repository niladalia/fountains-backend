<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainAccesBottles;
use App\Fountains\Domain\ValueObject\FountainAccesPets;
use App\Fountains\Domain\ValueObject\FountainAccessWheelchair;
use App\Fountains\Domain\ValueObject\FountainCreatedAt;
use App\Fountains\Domain\ValueObject\FountainDescription;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainName;
use App\Fountains\Domain\ValueObject\FountainOperationalStatus;
use App\Fountains\Domain\ValueObject\FountainPicture;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Fountains\Domain\ValueObject\FountainSafeWater;
use App\Fountains\Domain\ValueObject\FountainType;
use App\Fountains\Domain\ValueObject\FountainUpdatedAt;
use App\Fountains\Domain\ValueObject\FountainUserId;
use DateTimeZone;
use DateTime;
class Fountain
{
    private ?FountainCreatedAt $created_at = null;

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
        private ?FountainAccesBottles      $access_bottles,
        private ?FountainAccesPets         $access_pets,
        private ?FountainAccessWheelchair  $access_wheelchair,
        private ?FountainProviderName      $provider_name,
        private ?FountainProviderId        $provider_id,
        private ?FountainUserId            $user_id,
        private ?FountainUpdatedAt         $updated_at
    )
    {
        $this->created_at = new FountainCreatedAt(new DateTime('now', new DateTimeZone('UTC')));

        $this->updated_at = $updated_at->getValue() ?? new FountainUpdatedAt($this->created_at->getValue());

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
        ?FountainAccesBottles      $access_bottles,
        ?FountainAccesPets         $access_pets,
        ?FountainAccessWheelchair  $access_wheelchair,
        ?FountainProviderName      $provider_name,
        ?FountainProviderId        $provider_id,
        ?FountainUserId            $user_id,
        ?FountainUpdatedAt         $updated_at

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
            $access_bottles,
            $access_pets,
            $access_wheelchair,
            $provider_name,
            $provider_id,
            $user_id,
            $updated_at
        );
    }

    public function id(): ?FountainId
    {
        return $this->id;
    }

    public function name(): ?FountainName
    {
        return $this->name;
    }

    public function setName(?FountainName $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function lat(): FountainLat
    {
        return $this->lat;
    }

    public function setLat(FountainLat $lat): void
    {
        $this->lat = $lat;
    }

    public function long(): FountainLong
    {
        return $this->long;
    }

    public function setLong(FountainLong $long): void
    {
        $this->long = $long;
    }

    public function picture(): ?FountainPicture
    {
        return $this->picture;
    }

    public function setPicture(?FountainPicture $picture): void
    {
        $this->picture = $picture;
    }

    public function getType(): ?FountainType
    {
        return $this->fountain_type;
    }

    public function setType(?FountainType $fountain_type): void
    {
        $this->fountain_type = $fountain_type;
    }

    public function description(): ?FountainDescription
    {
        return $this->description;
    }

    public function setDescription(?FountainDescription $description): void
    {
        $this->description = $description;
    }

    public function operationa_status(): ?FountainOperationalStatus
    {
        return $this->operational_status;
    }

    public function setOperationalStatus(?FountainOperationalStatus $operational_status): void
    {
        $this->operational_status = $operational_status;
    }

    public function safe_water(): FountainSafeWater
    {
        return $this->safe_water;
    }

    public function setSafeWater(FountainSafeWater $safe_water): void
    {
        $this->safe_water = $safe_water;
    }

    public function access_bottles(): ?FountainAccesBottles
    {
        return $this->access_bottles;
    }

    public function setAccesBottles(?FountainAccesBottles $access_bottles): void
    {
        $this->access_bottles = $access_bottles;
    }

    public function access_pets(): ?FountainAccesPets
    {
        return $this->access_pets;
    }

    public function setAccesPets(?FountainAccesPets $access_pets): void
    {
        $this->access_pets = $access_pets;
    }

    public function access_wheelchair(): ?FountainAccessWheelchair
    {
        return $this->access_wheelchair;
    }

    public function setAccessWheelchair(?FountainAccessWheelchair $access_wheelchair): void
    {
        $this->access_wheelchair = $access_wheelchair;
    }

    public function provider_name(): ?FountainProviderName
    {
        return $this->provider_name;
    }

    public function setProviderName(?FountainProviderName $provider_name): void
    {
        $this->provider_name = $provider_name;
    }

    public function provider_id(): ?FountainProviderId
    {
        return $this->provider_id;
    }

    public function setProviderId(?FountainProviderId $provider_id): void
    {
        $this->provider_id = $provider_id;
    }

    public function user_id(): ?FountainUserId
    {
        return $this->user_id;
    }

    public function setUserId(?FountainUserId $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function updated_at(): ?FountainUpdatedAt
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?FountainUpdatedAt $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function created_at(): ?FountainCreatedAt
    {
        return $this->created_at;
    }


}
