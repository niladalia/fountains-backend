<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainFee;
use Faker\Factory;

class FountainFeeMother
{
    public static function create(?string $value = null): FountainFee
    {
        return new FountainFee($value ?? Factory::create()->boolean());
    }
}