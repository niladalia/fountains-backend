<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainLat;
use Faker\Factory;

class FountainLatMother
{
    public static function create(?string $value = null): FountainLat
    {
        return new FountainLat($value ?? Factory::create()->randomFloat(6,-90,90));
    }
}
