<?php

namespace App\Tests\Fountains\Domain\ValueObject;

enum FountainTypeMother : string
{
    case NATURAL = 'natural';
    case TAP_WATER = 'tap_water';
    case WATERING_PLACE = 'watering_place';
    case UNKNOWN = 'unknown';

    public static function fromString(?string $value): self
    {
        if ($value === null) {
            return self::UNKNOWN;
        }
        return self::from($value);
    }
}
