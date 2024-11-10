<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainOperationalStatus;
use Faker\Factory;

class FountainOperationalStatusMother
{
    public static function create(?string $value = null): FountainOperationalStatus
    {
        return new FountainOperationalStatus($value ?? Factory::create()->boolean());
    }
}
