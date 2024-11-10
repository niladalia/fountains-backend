<?php

namespace App\Tests\Fountains\Application\Find\DTO;

use App\Fountains\Application\Find\DTO\FindFountainRequest;

class FountainFinderRequestMother
{
    public static function create(
        ?string $id = null,
    ) {
        return new FindFountainRequest(
            $id,
        );
    }
}
