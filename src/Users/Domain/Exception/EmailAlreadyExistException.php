<?php

namespace App\Users\Domain\Exception;

use DomainException;

class EmailAlreadyExistException extends DomainException
{
    public static function throw(?string $email = '')
    {
        throw new self("Email {$email} already exists");
    }
    public function getStatusCode()
    {
        return 400;
    }
}