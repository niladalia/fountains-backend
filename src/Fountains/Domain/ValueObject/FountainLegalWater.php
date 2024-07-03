<?php

namespace App\Fountains\Domain\ValueObject;

use App\Shared\Domain\ValueObject\StringValueObject;

enum FountainLegalWater : string
{
    case TREATED = 'treated';
    case UNTREATED = 'untreated';
    case UNKNOWN = 'unknown';

    public static function fromString(string|null $value):self
    {
        if($value === null){
            return self::UNKNOWN;
        }
        return self::from($value);
    }
}
