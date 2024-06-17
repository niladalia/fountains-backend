<?php

namespace App\Fountains\Domain\ValueObject;

use App\Shared\Domain\ValueObject\StringValueObject;

enum FountainSafeWater : string
{
    case YES = 'yes';
    case PROBABLY = 'probably';
    case UNTREATED = 'untreated';
    case NO = 'no';
    case UNKNOWN = 'unknown';

    public static function fromString(string|null $value):self
    {
        if($value === null){
            return self::UNKNOWN;
        }
        return self::from($value);
    }
}
