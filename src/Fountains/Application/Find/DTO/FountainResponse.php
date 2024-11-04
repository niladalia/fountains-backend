<?php

namespace App\Fountains\Application\Find\DTO;

class FountainResponse
{
    public function __construct(
        private string $id,
        private string $lat,
        private string $long,
        private ?string $name,
        private ?string $type,
        private ?string $picture,
        private ?string $description,
        private ?string $operational_status,
        private ?string $safe_water,
        private ?string $legal_water,
        private ?string $access_bottles,
        private ?string $access_pets,
        private ?string $access_wheelchair,
        private ?string $access,
        private ?string $fee,
        private ?string $address,
        private ?string $website,
        private ?string $provider_name,
        private ?string $provider_id,
        private ?string $provider_updated_at,
        private ?string $provider_url,
        private ?string $userId
    )
    { }

    public function data():array
    {
        return [
            'id' => $this->id,
            'lat' => $this->lat,
            'long' => $this->long,
            'name' => $this->name,
            'type' => $this->type,
            'picture' => $this->picture,
            'description' => $this->description,
            'operational_status' => $this->operational_status,
            'safe_water' => $this->safe_water,
            'legal_water' => $this->legal_water,
            'access_bottles' => $this->access_bottles,
            'access_pets' => $this->access_pets,
            'access_wheelchair' => $this->access_wheelchair,
            'access' => $this->access,
            'fee' => $this->fee,
            'address' => $this->address,
            'website' => $this->website,
            'provider_name' => $this->provider_name,
            'provider_id' => $this->provider_id,
            'provider_updated_at' => $this->provider_updated_at,
            'provider_url' => $this->provider_url,
            'userId' => $this->userId
        ];
    }
}
