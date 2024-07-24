<?php

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\Utils\Uuid;

class UuidMother
{
    public static function create(): string
    {
        return Uuid::generate()->getValue();
    }
}