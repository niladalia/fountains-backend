<?php

namespace App\Users\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\ValueObject\StringValueObject;

class UserEmail extends StringValueObject
{
    protected function validate()
    {
        parent::validate();

        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            InvalidArgument::throw("Email $this->value is not valid");
        }
    }
}
