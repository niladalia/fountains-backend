<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainAddress;
use Faker\Factory;

class FountainAddressMother
{
    public static function create(?string $value = null): FountainAddress
    {
        return new FountainAddress($value ?? Factory::create()->text(50));
    }
}
