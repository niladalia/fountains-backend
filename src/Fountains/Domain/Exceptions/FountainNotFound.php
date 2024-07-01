<?php

namespace App\Fountains\Domain\Exceptions;
use DomainException;

class FountainNotFound extends DomainException
{
    public static function throw(?string $id = '')
    {
        throw new self("Fountain {$id} not found");
    }
    public function getStatusCode()
    {
        return 400;
    }
}