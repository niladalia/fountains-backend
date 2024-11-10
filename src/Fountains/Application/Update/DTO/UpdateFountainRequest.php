<?php

namespace App\Fountains\Application\Update\DTO;

use App\Fountains\Application\Create\DTO\FountainRequest;

class UpdateFountainRequest extends FountainRequest
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
}
