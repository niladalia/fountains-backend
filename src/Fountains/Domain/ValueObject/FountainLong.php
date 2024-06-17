<?php

namespace App\Fountains\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\ValueObject\FloatValueObject;

class FountainLong extends FloatValueObject
{
    protected function validate()
    {
        parent::validate();

        if ($this->value === null) {
            InvalidArgument::throw('La longitud no puede estar vacía.');
        }
    }
}