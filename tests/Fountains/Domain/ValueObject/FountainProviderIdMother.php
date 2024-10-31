<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainProviderId;
use Faker\Factory;

class FountainProviderIdMother
{
    public static function create(?string $value = null): FountainProviderId
    {
        return new FountainProviderId($value);
    }

    public static function generate(){

        return self::create(Factory::create()->text(50));

    }
}