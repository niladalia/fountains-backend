<?php

namespace App\Fountains\Domain\ValueObject;

enum FountainLegalWater : string
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

    public function getValue(): string
    {
        return $this->value;
    }
}
