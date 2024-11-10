<?php

namespace App\Fountains\Application\Create\DTO;

use DateTime;

class CreateFountainRequest extends FountainRequest
{
    public function __construct(
        string $id,
        float $lat,
        float $long,
        ?string $name = null,
        ?string $type = null,
        ?string $picture = null,
        ?string $description = null,
        ?bool $operational_status = null,
        ?string $safe_water = null,
        ?string $legal_water = null,
        ?bool $access_bottles = null,
        ?bool $access_pets = null,
        ?bool $access_wheelchair = null,
        ?string $access = null,
        ?bool $fee = null,
        ?string $address = null,
        private ?string $website = null,
        private ?string $provider_name = null,
        private ?string $provider_id = null,
        private ?DateTime $provider_updated_at = null,
        private ?string $provider_url = null,
        private ?string $user_id = null,
    ) {
        parent::__construct(
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
        );
    }

    public function website(): ?string
    {
        return $this->website;
    }

    public function provider_name(): ?string
    {
        return $this->provider_name;
    }
    public function provider_id(): ?string
    {
        return $this->provider_id;
    }

    public function provider_updated_at(): ?DateTime
    {
        return $this->provider_updated_at;
    }

    public function provider_url(): ?string
    {
        return $this->provider_url;
    }

    public function user_id(): ?string
    {
        return $this->user_id;
    }
}
