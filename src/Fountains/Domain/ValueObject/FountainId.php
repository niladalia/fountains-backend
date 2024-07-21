<?php

namespace App\Fountains\Domain\ValueObject;

use App\Shared\Domain\Utils\Uuid;

class FountainId extends Uuid
{
    // To create an instance, use FountainId::generate or FountainId::fromString
}