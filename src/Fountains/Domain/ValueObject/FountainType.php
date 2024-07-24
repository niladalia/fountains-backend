<?php

namespace App\Fountains\Domain\ValueObject;

enum FountainType : string
{
    case NATURAL = 'natural';
    case TAP_WATER = 'tap_water';
    case WATER_POINT = 'water_point';
    case WATERING_PLACE = 'watering_place';
    case UNKNOWN = 'unknown';

    public static function fromString(?string $value): self
    {
        if ($value === null) {
            return self::UNKNOWN;
        }
        return self::from($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
