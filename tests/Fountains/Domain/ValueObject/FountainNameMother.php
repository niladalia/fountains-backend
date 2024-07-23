<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainName;
use App\Shared\Domain\ValueObject\StringValueObject;

class FountainNameMother
{
    public static function create(?string $value = null): FountainName
    {
        return new FountainName($value ?? Factory::create()->words(mt_rand(3, 50), true));
    }
}