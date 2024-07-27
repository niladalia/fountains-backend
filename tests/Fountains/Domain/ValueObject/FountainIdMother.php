<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainId;
use App\Shared\Domain\Utils\Uuid;

class FountainIdMother
{
    public static function create(?string $value = null): FountainId
    {
        return FountainId::fromString($value ?? Uuid::generate());
    }
}