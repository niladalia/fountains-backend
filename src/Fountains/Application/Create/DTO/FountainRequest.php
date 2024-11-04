<?php

namespace App\Fountains\Application\Create\DTO;

use DateTime;

abstract class FountainRequest
{
    public function __construct(
        private string $id,
        private float $lat,
        private float $long,
        private ?string $name = null,
        private ?string $type = null,
        private ?string $picture = null,
        private ?string $description = null,
        private ?bool $operational_status = null,
        private ?string $safe_water = null,
        private ?string $legal_water = null,
        private ?bool $access_bottles = null,
        private ?bool $access_pets = null,
        private ?bool $access_wheelchair = null,
        private ?string $access = null,
        private ?bool $fee = null,
        private ?string $address = null
    ) {}

    public function id(): string
    {
        return $this->id;
    }

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

    public function type(): ?string
    {
        return $this->type;
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
    public function access(): ?string
    {
        return $this->access;
    }

    public function fee(): ?bool
    {
        return $this->fee;
    }

    public function address(): ?string
    {
        return $this->address;
    }
}
