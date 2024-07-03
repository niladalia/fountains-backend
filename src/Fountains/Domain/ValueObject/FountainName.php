<?php

namespace App\Fountains\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\ValueObject\StringValueObject;

class FountainName extends StringValueObject
{
    protected function validate()
    {
        if ($this->value == null) {
            return null;
        }
    }
}