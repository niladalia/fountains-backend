<?php

namespace App\Users\Domain\Exception;

use DomainException;

class UserNotExistException extends DomainException
{
    public static function throw(?string $message = '')
    {
        throw new self($message);
    }
    public function getStatusCode()
    {
        return 400;
    }
}
