<?php

namespace App\Shared\Domain\Exceptions;

use DomainException;

class InvalidArgument extends DomainException
{
    public static function throw(?string $message = "Invalid argument")
    {
        throw new self($message);
    }

    public function getStatusCode()
    {
        return 400;
    }
}
