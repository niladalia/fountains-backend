<?php

namespace App\Fountains\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\ValueObject\FloatValueObject;

class FountainLat extends FloatValueObject
{
    protected function validate()
    {
        if ($this->value === null) {
            InvalidArgument::throw('La latitud no puede estar vacía.');
        }
    }
}
