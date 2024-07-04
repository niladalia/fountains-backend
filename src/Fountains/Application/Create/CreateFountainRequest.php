<?php

namespace App\Fountains\Application\Create;

use DateTime;

class CreateFountainRequest
{
    public function __construct(
        private float $lat,
        private float $long,
        private ?string $name,
        private ?string $fountain_type = null,
        private ?string $picture = null,
        private ?string $description = null,
        private ?bool $operational_status = null,
        private ?string $safe_water,
        private ?string $legal_water,
        private ?bool $access_bottles = null,
        private ?bool $access_pets = null,
        private ?bool $access_wheelchair = null,
        private ?string $provider_name = null,
        private ?string $provider_id = null,
        private ?string $user_id = null,
        private ?DateTime $provider_updated_at = null
    ) {}

    public function lat(): float
    {
        return $this->lat;
    }

    public function long(): float
    {
        return $this->long;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function fountain_type(): ?string
    {
        return $this->fountain_type;
    }

    public function picture(): ?string
    {
        return $this->picture;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function operational_status(): ?bool
    {
        return $this->operational_status;
    }

    public function safe_water(): ?string
    {
        return $this->safe_water;
    }

    public function legal_water(): ?string
    {
        return $this->legal_water;
    }

    public function access_bottles(): ?bool
    {
        return $this->access_bottles;
    }

    public function access_pets(): ?bool
    {
        return $this->access_pets;
    }

    public function access_wheelchair(): ?bool
    {
        return $this->access_wheelchair;
    }

    public function provider_name(): ?string
    {
        return $this->provider_name;
    }
    public function provider_id(): ?string
    {
        return $this->provider_id;
    }

    public function user_id(): ?string
    {
        return $this->user_id;
    }

    public function provider_updated_at(): ?DateTime
    {
        return $this->provider_updated_at;
    }

}