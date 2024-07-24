<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainSafeWater;

enum FountainSafeWaterMother : string
{
    case YES = 'yes';
    case PROBABLY = 'probably';
    case NO = 'no';
    case UNKNOWN = 'unknown';

    public static function create(?string $value = ''): FountainSafeWater
    {
        if ($value === '') {
            $options = array_column(self::cases(), 'value');
            $value = $options[array_rand($options)];
        }
        return FountainSafeWater::fromString($value);
    }
}
