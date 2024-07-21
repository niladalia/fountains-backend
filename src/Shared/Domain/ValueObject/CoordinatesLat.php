<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\ValueObject\FloatValueObject;

class CoordinatesLat extends FloatValueObject
{
    protected function validate()
    {
        if ($this->value === null) {
            InvalidArgument::throw('La latitud no puede estar vacía.');
        }
    }
}
