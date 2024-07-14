<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class BooleanValueObject extends ValueObject
{
    public function __construct(?bool $value = null)
    {
        parent::__construct($value);
    }

    public function getValue(): ?bool
    {
        return $this->value;
    }
}
