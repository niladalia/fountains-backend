<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class StringValueObject implements \Stringable
{
    public function __construct(protected ?string $value = null) {}

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function __tostring(): string
    {
        return $this->getValue() ?? '';
    }
}
