<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainProviderName;

class FountainProviderNameMother
{
    public static function create(?string $value = null): FountainProviderName
    {
        return new FountainProviderName($value);
    }
}