<?php

namespace App\Fountains\Domain\ValueObject;

use App\Shared\Domain\Utils\Uuid;
use App\Shared\Domain\ValueObject\UuidValueObject;

class FountainId extends Uuid
{
    // To create an instance, use FountainId::generate or FountainId::fromString
}