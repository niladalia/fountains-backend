<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainUserId;
use App\Shared\Domain\Utils\Uuid;

class FountainUserIdMother
{
    public static function create(?string $value = null): FountainUserId
    {
        return new FountainUserId($value ? Uuid::fromString($value) :  Uuid::generate());
    }
}