<?php

namespace App\Fountains\Domain\ValueObject;

use App\Shared\Domain\ValueObject\StringValueObject;

enum FountainType: string
{
    case NATURAL = 'natural';
    case TAP_WATER = 'tap_water';
    case WATERING_PLACE = 'watering_place';
    case UNKNOWN = 'unknown';


    public static function fromString(string|null $value):self
    {
        if($value === null){
            return self::UNKNOWN;
        }
        return self::from($value);
    }
}
