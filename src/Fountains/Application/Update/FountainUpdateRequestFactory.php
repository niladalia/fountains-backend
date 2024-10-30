<?php

namespace App\Fountains\Application\Update;

use App\Fountains\Application\Create\DTO\FountainRequest;
use App\Fountains\Application\Update\DTO\UpdateFountainRequest;

class FountainUpdateRequestFactory
{
    public static function fromFountainRequest(string $id, FountainRequest $fountain): UpdateFountainRequest
    {
        return new UpdateFountainRequest(
            $id,
            $fountain->lat(),
            $fountain->long(),
            $fountain->name(),
            $fountain->type(),
            $fountain->picture(),
            $fountain->description(),
            $fountain->operational_status(),
            $fountain->safe_water(),
            $fountain->legal_water(),
            $fountain->access_bottles(),
            $fountain->access_pets(),
            $fountain->access_wheelchair(),
            $fountain->access(),
            $fountain->fee(),
            $fountain->address(),
            $fountain->website(),
            $fountain->provider_name(),
            $fountain->provider_id(),
            $fountain->provider_updated_at(),
            $fountain->provider_url(),
            $fountain->user_id()
        );
    }
}