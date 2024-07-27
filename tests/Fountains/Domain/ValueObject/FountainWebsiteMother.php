<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainWebsite;
use Faker\Factory;

class FountainWebsiteMother
{
    public static function create(?string $value = null): FountainWebsite
    {
        return new FountainWebsite($value ?? Factory::create()->text(100));
    }
}