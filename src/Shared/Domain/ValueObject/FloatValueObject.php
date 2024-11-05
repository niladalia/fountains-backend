<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class FloatValueObject
{
    public function __construct(protected ?float $value = null) {}

    public function getValue(): ?float
    {
        return $this->value;
    }
}
