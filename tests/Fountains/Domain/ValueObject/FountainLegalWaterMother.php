<?php

namespace App\Tests\Fountains\Domain\ValueObject;

enum FountainLegalWaterMother : string
{
    case TREATED = 'treated';
    case UNTREATED = 'untreated';
    case UNKNOWN = 'unknown';

    public static function fromString(?string $value): self
    {
        if ($value === null) {
            return self::UNKNOWN;
        }
        return self::from($value);
    }
}
