<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainType;

enum FountainTypeMother: string
{
    case NATURAL = 'natural';
    case TAP_WATER = 'tap_water';
    case WATERING_PLACE = 'watering_place';
    case UNKNOWN = 'unknown';

    public static function create(?string $value = ''): FountainType
    {
        if ($value === '') {
            $options = array_column(self::cases(), 'value');
            $value = $options[array_rand($options)];
        }
        return FountainType::fromString($value);
    }
}
