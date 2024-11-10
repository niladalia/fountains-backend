<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainUpdatedAt;
use Faker\Factory;

class FountainUpdatedAtMother
{
    public static function create(?string $value = null): FountainUpdatedAt
    {
        return new FountainUpdatedAt($value ?? Factory::create()->dateTime());
    }
}
