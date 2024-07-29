<?php

namespace App\Tests\Fountains\Infrastructure\Controllers;

use App\Tests\Fountains\Domain\ValueObject\FountainAccesBottlesMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAccesPetsMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAccessMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAccessWheelchairMother;
use App\Tests\Fountains\Domain\ValueObject\FountainAddressMother;
use App\Tests\Fountains\Domain\ValueObject\FountainDescriptionMother;
use App\Tests\Fountains\Domain\ValueObject\FountainFeeMother;
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

class FountainHttpRequestBuilder
{
    private $lat;
    private $long;
    private $name;
    private $type;
    private $picture;
    private $description;
    private $operational_status;
    private $safe_water;
    private $legal_water;
    private $access_bottles;
    private $access_pets;
    private $access_wheelchair;
    private $access;
    private $fee;
    private $address;
    private $website;
    private $provider_name;
    private $provider_id;
    private $provider_updated_at;
    private $provider_url;
    private $user_id;
    private $userRequest = false;
    private $providerRequest = false;

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;
        return $this;
    }

    public function setLong(?float $long): self
    {
        $this->long = $long;
        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setOperationalStatus(?bool $operational_status): self
    {
        $this->operational_status = $operational_status;
        return $this;
    }

    public function setSafeWater(?string $safe_water): self
    {
        $this->safe_water = $safe_water;
        return $this;
    }

    public function setLegalWater(?string $legal_water): self
    {
        $this->legal_water = $legal_water;
        return $this;
    }

    public function setAccessBottles(?bool $access_bottles): self
    {
        $this->access_bottles = $access_bottles;
        return $this;
    }

    public function setAccessPets(?bool $access_pets): self
    {
        $this->access_pets = $access_pets;
        return $this;
    }

    public function setAccessWheelchair(?bool $access_wheelchair): self
    {
        $this->access_wheelchair = $access_wheelchair;
        return $this;
    }

    public function setAccess(?string $access): self
    {
        $this->access = $access;
        return $this;
    }

    public function setFee(?bool $fee): self
    {
        $this->fee = $fee;
        return $this;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;
        return $this;
    }

    public function setProviderName(?string $provider_name): self
    {
        $this->provider_name = $provider_name;
        return $this;
    }

    public function setProviderId(?string $provider_id): self
    {
        $this->provider_id = $provider_id;
        return $this;
    }

    public function setProviderUpdatedAt(?DateTime $provider_updated_at): self
    {
        $this->provider_updated_at = $provider_updated_at;
        return $this;
    }

    public function setProviderUrl(?string $provider_url): self
    {
        $this->provider_url = $provider_url;
        return $this;
    }

    public function setUserId(?string $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function setUserRequest(){
        $this->userRequest = true;
        return $this;
    }

    public function setProviderRequest(){
        $this->providerRequest = true;
        return $this;
    }

    public function build(): array
    {
        if ($this->userRequest) {
            $this->user_id = $this->user_id ?? FountainUserIdMother::create()->__tostring();
        }

        if ($this->providerRequest) {
            $this->provider_name = $this->provider_name ?? FountainProviderNameMother::create()->getValue();
            $this->provider_id = $this->provider_id ?? FountainProviderIdMother::create()->getValue();
            $this->provider_updated_at = $this->provider_updated_at ?? FountainProviderUpdatedAtMother::create()->formatISO();
            $this->provider_url = $this->provider_url ?? FountainProviderUrlMother::create()->getValue();
        }

        // Fallback for user_id if neither userRequest nor providerRequest is explicitly true
        if (!$this->userRequest && !$this->providerRequest) {
            $this->user_id = $this->user_id ?? FountainUserIdMother::create()->getValue();
        }

        return [
            "lat" => $this->lat ?? FountainLatMother::create()->getValue(),
            "long" => $this->long ?? FountainLongMother::create()->getValue(),
            "name" => $this->name ?? FountainNameMother::create()->getValue(),
            "type" => $this->type ?? FountainTypeMother::create()->getValue(),
            "picture" => $this->picture ?? FountainPictureMother::create()->getValue(),
            "description" => $this->description ?? FountainDescriptionMother::create()->getValue(),
            "operational_status" => $this->operational_status ?? FountainOperationalStatusMother::create()->getValue(),
            "safe_water" => $this->safe_water ?? FountainSafeWaterMother::create()->getValue(),
            "legal_water" => $this->legal_water ?? FountainLegalWaterMother::create()->getValue(),
            "access_bottles" => $this->access_bottles ?? FountainAccesBottlesMother::create()->getValue(),
            "access_pets" => $this->access_pets ?? FountainAccesPetsMother::create()->getValue(),
            "access_wheelchair" => $this->access_wheelchair ?? FountainAccessWheelchairMother::create()->getValue(),
            "access" => $this->access ?? FountainAccessMother::create()->getValue(),
            "fee" => $this->fee ?? FountainFeeMother::create()->getValue(),
            "address" => $this->address ?? FountainAddressMother::create()->getValue(),
            "website" => $this->website ?? FountainWebsiteMother::create()->getValue(),
            "provider_name" => $this->provider_name,
            "provider_id" => $this->provider_id,
            "provider_updated_at" => $this->provider_updated_at,
            "provider_url" => $this->provider_url,
            "user_id" => $this->user_id
        ];
    }
}
