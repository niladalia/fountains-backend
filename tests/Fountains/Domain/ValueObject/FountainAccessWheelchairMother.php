<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainAccessWheelchair;
use Faker\Factory;

class FountainAccessWheelchairMother 
{
    public static function create(?string $value = null): FountainAccessWheelchair
    {
        return new FountainAccessWheelchair($value ?? Factory::create()->boolean());
    }
}