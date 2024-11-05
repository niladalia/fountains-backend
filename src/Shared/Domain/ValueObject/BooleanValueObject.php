<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class BooleanValueObject
{
    public function __construct(protected ?bool $value = null) {}

    public function getValue(): ?bool
    {
        return $this->value;
    }
}
