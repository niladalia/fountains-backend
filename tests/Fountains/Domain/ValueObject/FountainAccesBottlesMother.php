<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainAccesBottles;
use Faker\Factory;

class FountainAccesBottlesMother
{
    public static function create(?string $value = null): FountainAccesBottles
    {
        return new FountainAccesBottles($value ?? Factory::create()->boolean());
    }
}
