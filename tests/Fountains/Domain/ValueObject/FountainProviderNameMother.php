<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainProviderName;
use Faker\Factory;

class FountainProviderNameMother
{
    public static function create(?string $value = null): FountainProviderName
    {
        return new FountainProviderName($value);
    }
}