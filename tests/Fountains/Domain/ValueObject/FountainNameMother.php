<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainName;
use Faker\Factory;

class FountainNameMother
{
    public static function create(?string $value = null): FountainName
    {
        return new FountainName($value ?? Factory::create()->text(50));
    }
}