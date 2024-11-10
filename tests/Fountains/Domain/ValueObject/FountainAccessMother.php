<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainAccess;

enum FountainAccessMother: string
{
    case YES = 'yes';
    case PERMISSIVE = 'permissive';
    case CUSTOMERS = 'customers';
    case PERMIT = 'permit';
    case PRIVATE = 'private';
    case NO = 'no';
    case UNKNOWN = 'unknown';

    public static function create(?string $value = ''): FountainAccess
    {
        if ($value === '') {
            $options = array_column(self::cases(), 'value');
            $value = $options[array_rand($options)];
        }

        return FountainAccess::fromString($value);
    }
}
