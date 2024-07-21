<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\ValueObject\FloatValueObject;

class CoordinatesLong extends FloatValueObject
{
    protected function validate()
    {
        if ($this->value === null) {
            InvalidArgument::throw('La longitud no puede estar vacía.');
        }
    }
}
