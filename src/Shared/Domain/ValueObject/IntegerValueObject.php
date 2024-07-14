<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class IntegerValueObject extends ValueObject
{
    public function __construct(?int $value = null)
    {
        parent::__construct($value);
    }

    public function getValue(): ?int
    {
        return $this->value;
    }
}
