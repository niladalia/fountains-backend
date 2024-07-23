<?php

namespace App\Tests\Fountains\Domain\ValueObject;

enum FountainSafeWaterMother : string
{
    case YES = 'yes';
    case PROBABLY = 'probably';
    case NO = 'no';
    case UNKNOWN = 'unknown';

    public static function fromString(?string $value): self
    {
        if ($value === null) {
            return self::UNKNOWN;
        }
        return self::from($value);
    }
}
