<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainPicture;
use Faker\Factory;

class FountainPictureMother
{
    public static function create(?string $value = null): FountainPicture
    {
        return new FountainPicture($value ?? Factory::create()->text(100));
    }
}