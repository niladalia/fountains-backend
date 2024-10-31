<?php

namespace App\Fountains\Domain;

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
use App\Fountains\Domain\ValueObject\FountainCreatedAt;
use App\Fountains\Domain\ValueObject\FountainUpdatedAt;

use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\Utils\DateTimeUtils;
use App\Users\Domain\User;

class Fountain extends AggregateRoot
{
    public function __construct(
        private FountainId                $id,
        private FountainLat               $lat,
        private FountainLong              $long,
        private FountainName              $name,
        private FountainType              $type,
        private FountainPicture           $picture,
        private FountainDescription       $description,
        private FountainOperationalStatus $operational_status,
        private FountainSafeWater         $safe_water,
        private FountainLegalWater        $legal_water,
        private FountainAccesBottles      $access_bottles,
        private FountainAccesPets         $access_pets,
        private FountainAccessWheelchair  $access_wheelchair,
        private FountainAccess            $access,
        private FountainFee               $fee,
        private FountainAddress           $address,
        private FountainWebsite           $website,
        private FountainProviderName      $provider_name,
        private FountainProviderId        $provider_id,
        private FountainProviderUpdatedAt $provider_updated_at,
        private FountainProviderUrl       $provider_url,
        private FountainCreatedAt         $created_at,
        private FountainUpdatedAt         $updated_at,
        private ?User                     $user
    ) { }

    public static function create(
        FountainId                $id,
        FountainLat               $lat,
        FountainLong              $long,
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
        ?User                      $user,
    ): self
    {
        $now = DateTimeUtils::now();
        $created_at = new FountainCreatedAt($now);
        $updated_at = new FountainUpdatedAt($now);

        return new self(
            $id,
            $lat,
            $long,
            $name,
            $type,
            $picture,
            $description,
            $operational_status,
            $safe_water,
            $legal_water,
            $access_bottles,
            $access_pets,
            $access_wheelchair,
            $access,
            $fee,
            $address,
            $website,
            $provider_name,
            $provider_id,
            $provider_updated_at,
            $provider_url,
            $created_at,
            $updated_at,
            $user
        );
    }

    public function update(
        FountainLat               $lat,
        FountainLong              $long,
        FountainName              $name,
        FountainType              $type,
        FountainPicture           $picture,
        FountainDescription       $description,
        FountainOperationalStatus $operational_status,
        FountainSafeWater         $safe_water,
        FountainLegalWater        $legal_water,
        FountainAccesBottles      $access_bottles,
        FountainAccesPets         $access_pets,
        FountainAccessWheelchair  $access_wheelchair,
        FountainAccess            $access,
        FountainFee               $fee,
        FountainAddress           $address,
        FountainWebsite           $website,
        FountainProviderName      $provider_name,
        FountainProviderId        $provider_id,
        FountainProviderUpdatedAt $provider_updated_at,
        FountainProviderUrl       $provider_url,
        ?User            $user = null,
    ): void {
        $this->updateName($name);
        $this->updateLat($lat);
        $this->updateLong($long);
        $this->updatePicture($picture);
        $this->updateType($type);
        $this->updateDescription($description);
        $this->updateOperationalStatus($operational_status);
        $this->updateSafeWater($safe_water);
        $this->updateLegalWater($legal_water);
        $this->updateAccesBottles($access_bottles);
        $this->updateAccesPets($access_pets);
        $this->updateAccessWheelchair($access_wheelchair);
        $this->updateAccess($access);
        $this->updateFee($fee);
        $this->updateAddress($address);
        $this->updateWebsite($website);
        $this->updateProviderName($provider_name);
        $this->updateProviderId($provider_id);
        $this->updateProviderUpdatedAt($provider_updated_at);
        $this->updateProviderUrl($provider_url);
        $this->updateUser($user);
    }

    public function id(): FountainId
    {
        return $this->id;
    }

    public function name(): FountainName
    {
        return $this->name;
    }

    public function updateName(FountainName $name): void
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

    public function picture(): FountainPicture
    {
        return $this->picture;
    }

    public function updatePicture(FountainPicture $picture): void
    {
        $this->picture = $picture;
    }

    public function type(): FountainType
    {
        return $this->type;
    }

    public function updateType(FountainType $type): void
    {
        $this->type = $type;
    }

    public function description(): FountainDescription
    {
        return $this->description;
    }

    public function updateDescription(FountainDescription $description): void
    {
        $this->description = $description;
    }

    public function operational_status(): FountainOperationalStatus
    {
        return $this->operational_status;
    }

    public function updateOperationalStatus(FountainOperationalStatus $operational_status): void
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

    public function access_bottles(): FountainAccesBottles
    {
        return $this->access_bottles;
    }

    public function updateAccesBottles(FountainAccesBottles $access_bottles): void
    {
        $this->access_bottles = $access_bottles;
    }

    public function access_pets(): FountainAccesPets
    {
        return $this->access_pets;
    }

    public function updateAccesPets(FountainAccesPets $access_pets): void
    {
        $this->access_pets = $access_pets;
    }

    public function access_wheelchair(): FountainAccessWheelchair
    {
        return $this->access_wheelchair;
    }

    public function updateAccessWheelchair(FountainAccessWheelchair $access_wheelchair): void
    {
        $this->access_wheelchair = $access_wheelchair;
    }

    public function access(): FountainAccess
    {
        return $this->access;
    }

    public function updateAccess(FountainAccess $access): void
    {
        $this->access = $access;
    }

    public function fee(): FountainFee
    {
        return $this->fee;
    }

    public function updateFee(FountainFee $fee): void
    {
        $this->fee = $fee;
    }

    public function address(): FountainAddress
    {
        return $this->address;
    }

    public function updateAddress(FountainAddress $address): void
    {
        $this->address = $address;
    }

    public function website(): FountainWebsite
    {
        return $this->website;
    }

    public function updateWebsite(FountainWebsite $website): void
    {
        $this->website = $website;
    }

    public function provider_name(): FountainProviderName
    {
        return $this->provider_name;
    }

    public function updateProviderName(FountainProviderName $provider_name): void
    {
        $this->provider_name = $provider_name;
    }

    public function provider_id(): FountainProviderId
    {
        return $this->provider_id;
    }

    public function updateProviderId(FountainProviderId $provider_id): void
    {
        $this->provider_id = $provider_id;
    }

    public function provider_updated_at(): FountainProviderUpdatedAt
    {
        return $this->provider_updated_at;
    }

    public function updateProviderUpdatedAt(FountainProviderUpdatedAt $provider_updated_at): void
    {
        $this->provider_updated_at = $provider_updated_at;
    }

    public function provider_url(): FountainProviderUrl
    {
        return $this->provider_url;
    }

    public function updateProviderUrl(FountainProviderUrl $provider_url): void
    {
        $this->provider_url = $provider_url;
    }

    public function user(): ?User
    {
        return $this->user;
    }

    public function updateUser(?User $user): void
    {
        $this->user = $user;
    }

    public function updated_at(): FountainUpdatedAt
    {
        return $this->updated_at;
    }

    public function created_at(): FountainCreatedAt
    {
        return $this->created_at;
    }

    public function toArray(): array
    {
        $result =  [
            'id' => $this->id()->getValue(),
            'lat' => $this->lat()->getValue(),
            'long' => $this->long()->getValue(),
            'type' => $this->type()->getValue(),
            'name' => $this->name()->getValue(),
            'picture' => $this->picture()->getValue(),
            'description' => $this->description()->getValue(),
            'operational_status' => $this->operational_status()->getValue(),
            'safe_water' => $this->safe_water()->getValue(),
            'legal_water' => $this->legal_water()->getValue(),
            'access_bottles' => $this->access_bottles()->getValue(),
            'access_pets' => $this->access_pets()->getValue(),
            'access_wheelchair' => $this->access_wheelchair()->getValue(),
            'access' => $this->access()->getValue(),
            'fee' => $this->fee()->getValue(),
            'address' => $this->address()->getValue(),
            'website' => $this->website()->getValue(),
            'provider_name' => $this->provider_name()->getValue(),
            'provider_id' => $this->provider_id()->getValue(),
            'provider_updated_at' => $this->provider_updated_at()->formatISO(),
            'provider_url' => $this->provider_url()->getValue(),
            'user_id' => $this->user() ? $this->user->id()->getValue() : null,
            'updated_at' => $this->updated_at()->formatISO(),
            'created_at' => $this->created_at()->formatISO()
        ];

        return array_filter($result, function($value) {
            return $value !== null;
        });
    }

}
