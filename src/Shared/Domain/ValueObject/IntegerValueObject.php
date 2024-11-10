<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class IntegerValueObject
{
    public function __construct(protected ?int $value = null) {}

    public function getValue(): ?int
    {
        return $this->value;
    }
}
