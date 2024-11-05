<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Application\Find\DTO\FountainResponse;
use App\Fountains\Domain\Fountain;

final class FountainResponseFactory
{
    public function __invoke(Fountain $fountain): FountainResponse
    {
        return new FountainResponse(
            $fountain->id()->getValue(),
            $fountain->lat()->getValue(),
            $fountain->long()->getValue(),
            $fountain->name()->getValue(),
            $fountain->type()->getValue(),
            $fountain->picture()->getValue(),
            $fountain->description()->getValue(),
            $fountain->operational_status()->getValue(),
            $fountain->safe_water()->getValue(),
            $fountain->legal_water()->getValue(),
            $fountain->access_bottles()->getValue(),
            $fountain->access_pets()->getValue(),
            $fountain->access_wheelchair()->getValue(),
            $fountain->access()->getValue(),
            $fountain->fee()->getValue(),
            $fountain->address()->getValue(),
            $fountain->website()->getValue(),
            $fountain->provider_name()->getValue(),
            $fountain->provider_id()->getValue(),
            $fountain->provider_updated_at()->getValue(),
            $fountain->provider_url()->getValue(),
            $fountain->user() ? $fountain->user()->id()->getValue() : null
        );
    }
}
