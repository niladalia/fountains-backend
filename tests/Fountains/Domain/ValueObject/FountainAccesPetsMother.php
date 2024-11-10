<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainAccesPets;
use Faker\Factory;

class FountainAccesPetsMother
{
    public static function create(?string $value = null): FountainAccesPets
    {
        return new FountainAccesPets($value ?? Factory::create()->boolean());
    }
}
