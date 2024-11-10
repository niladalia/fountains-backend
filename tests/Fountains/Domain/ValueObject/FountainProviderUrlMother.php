<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainProviderUrl;

class FountainProviderUrlMother
{
    public static function create(?string $value = null): FountainProviderUrl
    {
        return new FountainProviderUrl($value);
    }
}
