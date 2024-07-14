<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class FloatValueObject extends ValueObject
{
    public function __construct(?float $value = null)
    {
        parent::__construct($value);
    }

    public function getValue(): ?float
    {
        return $this->value;
    }
}
