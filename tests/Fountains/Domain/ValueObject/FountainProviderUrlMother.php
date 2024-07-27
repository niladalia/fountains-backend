<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainAddress;
use App\Fountains\Domain\ValueObject\FountainProviderUrl;
use Faker\Factory;

class FountainProviderUrlMother
{
    public static function create(?string $value = null): FountainProviderUrl
    {
        return new FountainProviderUrl($value ?? Factory::create()->text(100));
    }
}