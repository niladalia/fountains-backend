<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\Create\CreateFountainRequest;
use App\Fountains\Application\Update\UpdateFountainRequest;

use DateTime;

class CreateOrUpdateFountainRequest extends CreateFountainRequest
{
    public function __construct(
        private ?string $id,
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
        ?string $provider_name = null,
        ?string $provider_id = null,
        ?string $user_id = null,
        ?DateTime $provider_updated_at = null
    )
    {
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
            $provider_name,
            $provider_id,
            $user_id,
            $provider_updated_at
        );
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function toUpdateFountainRequest(string $fountainId): UpdateFountainRequest
    {
        return new UpdateFountainRequest(
            $fountainId,
            $this->lat(),
            $this->long(),
            $this->name(),
            $this->type(),
            $this->picture(),
            $this->description(),
            $this->operational_status(),
            $this->safe_water(),
            $this->legal_water(),
            $this->access_bottles(),
            $this->access_pets(),
            $this->access_wheelchair(),
            $this->provider_name(),
            $this->provider_id(),
            $this->user_id(),
            $this->provider_updated_at()
        );
    }

}