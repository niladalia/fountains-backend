<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;

class CoordinatesLat extends FloatValueObject
{
    protected function validate()
    {
        if ($this->value === null) {
            InvalidArgument::throw('La latitud no puede estar vacía.');
        }
    }
}
