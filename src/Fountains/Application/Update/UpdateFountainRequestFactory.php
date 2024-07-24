<?php

namespace App\Fountains\Application\Update;

use App\Fountains\Application\Create\DTO\FountainRequest;
use App\Fountains\Application\Update\DTO\UpdateFountainRequest;
use App\Fountains\Domain\Fountain;

abstract class UpdateFountainRequestFactory
{
    public static function fromFountainRequest(
        string $fountainId,
        FountainRequest $request,
        ?FountainRequest $default = null
    ): UpdateFountainRequest
    {
        return new UpdateFountainRequest(
            $fountainId,
            $request->lat(),
            $request->long(),
            $request->name() ?? $default?->name(),
            $request->type() ?? $default?->type(),
            $request->picture() ?? $default?->picture(),
            $request->description() ?? $default?->description(),
            $request->operational_status() ?? $default?->operational_status(),
            $request->safe_water() ?? $default?->safe_water(),
            $request->legal_water() ?? $default?->legal_water(),
            $request->access_bottles() ?? $default?->access_bottles(),
            $request->access_pets() ?? $default?->access_pets(),
            $request->access_wheelchair() ?? $default?->access_wheelchair(),
            $request->access() ?? $default?->access(),
            $request->fee() ?? $default?->fee(),
            $request->address() ?? $default?->address(),
            $request->website() ?? $default?->website(),
            $request->provider_name() ?? $default?->provider_name(),
            $request->provider_id() ?? $default?->provider_id(),
            $request->provider_updated_at() ?? $default?->provider_updated_at(),
            $request->provider_url() ?? $default?->provider_url(),
            $request->user_id() ?? $default?->user_id()
        );
    }

    public static function fromFountain(Fountain $fountain): UpdateFountainRequest
    {
        return new UpdateFountainRequest(
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
            $fountain->user_id()->getValue(),
        );
    }
}