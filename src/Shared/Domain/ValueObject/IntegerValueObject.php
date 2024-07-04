<?php

namespace App\Shared\Domain\ValueObject;

abstract class IntegerValueObject
{
    protected ?int $value;

    public function __construct(?int $value = null)
    {
        $this->value = $value;
        $this->validate();
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    protected function validate(){ }
}
