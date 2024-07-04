<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class StringValueObject extends ValueObject
{
    public function __construct(?string $value = null)
    {
        parent::__construct($value);
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
