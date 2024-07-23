<?php

namespace App\Fountains\Domain\ValueObject;

enum FountainAccess : string
{
    case YES = 'yes';
    case PERMISSIVE = 'permissive';
    case CUSTOMERS = 'customers';
    case PERMIT = 'permit';
    case PRIVATE = 'private';
    case NO = 'no';
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
