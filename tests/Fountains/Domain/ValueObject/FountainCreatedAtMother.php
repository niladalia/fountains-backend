<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainCreatedAt;
use Faker\Factory;

class FountainCreatedAtMother
{
    public static function create(?string $value = null): FountainCreatedAt
    {
        return new FountainCreatedAt($value ?? Factory::create()->dateTime());
    }
}