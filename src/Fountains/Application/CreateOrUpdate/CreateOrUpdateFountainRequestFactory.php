<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\Create\CreateFountainRequest;
use App\Fountains\Application\Update\UpdateFountainRequest;

class CreateOrUpdateFountainRequestFactory
{
    public static function toCreateFountainRequest(CreateOrUpdateFountainRequest $request): CreateFountainRequest
    {
        return new CreateFountainRequest(
            $request->id(),
            $request->lat(),
            $request->long(),
            $request->name(),
            $request->fountain_type(),
            $request->picture(),
            $request->description(),
            $request->operational_status(),
            $request->safe_water(),
            $request->legal_water(),
            $request->access_bottles(),
            $request->access_pets(),
            $request->access_wheelchair(),
            $request->provider_name(),
            $request->provider_id(),
            $request->user_id(),
            $request->provider_updated_at(),
            $request->updated_at()
        );
    }

    public static function toUpdateFountainRequest(CreateOrUpdateFountainRequest $request): UpdateFountainRequest
    {
        return new UpdateFountainRequest(
            $request->id(),
            $request->lat(),
            $request->long(),
            $request->name(),
            $request->fountain_type(),
            $request->picture(),
            $request->description(),
            $request->operational_status(),
            $request->safe_water(),
            $request->legal_water(),
            $request->access_bottles(),
            $request->access_pets(),
            $request->access_wheelchair(),
            $request->provider_name(),
            $request->provider_id(),
            $request->user_id(),
            $request->provider_updated_at(),
            $request->updated_at()
        );
    }
}