<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainLegalWater;

enum FountainLegalWaterMother : string
{
    case TREATED = 'treated';
    case UNTREATED = 'untreated';
    case UNKNOWN = 'unknown';

    public static function create(?string $value = ''): FountainLegalWater
    {
        if ($value === '') {
            $options = array_column(self::cases(), 'value');
            $value = $options[array_rand($options)];
        }

        return FountainLegalWater::fromString($value);
    }
}
