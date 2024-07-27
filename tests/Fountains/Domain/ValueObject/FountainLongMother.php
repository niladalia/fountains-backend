<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainLong;
use Faker\Factory;

class FountainLongMother
{
    public static function create(?string $value = null): FountainLong
    {
        return new FountainLong($value ?? Factory::create()->randomFloat(6,-90,90));
    }
}
