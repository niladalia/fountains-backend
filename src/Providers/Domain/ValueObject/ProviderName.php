<?php

namespace App\Providers\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\ValueObject\StringValueObject;

class ProviderName extends StringValueObject
{
    protected function validate()
    {
        if ($this->value == null) {
            return null;
        }
    }
}