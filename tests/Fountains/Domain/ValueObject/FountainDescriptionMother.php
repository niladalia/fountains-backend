<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainDescription;
use Faker\Factory;

class FountainDescriptionMother
{
    public static function create(?string $value = null): FountainDescription
    {
        return new FountainDescription($value ?? Factory::create()->words(mt_rand(3, 50), true));
    }
}