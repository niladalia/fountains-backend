<?php

namespace App\Users\Domain\Exception;

use DomainException;

class WrongPasswordException extends DomainException
{
    public static function throw(?string $email = '')
    {
        throw new self("Wrong password.");
    }
    public function getStatusCode()
    {
        return 400;
    }
}
