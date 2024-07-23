<?php

namespace App\Fountains\Application\Create\DTO;

use DateTime;

class CreateFountainRequest extends FountainRequest
{
    public function __construct(
        private string $id,
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
        ?string $website = null,
        ?string $provider_name = null,
        ?string $provider_id = null,
        ?DateTime $provider_updated_at = null,
        ?string $provider_url = null,
        ?string $user_id = null
    ) {
        parent::__construct(
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
            $user_id
        );
    }

    public function id(): string
    {
        return $this->id;
    }
}