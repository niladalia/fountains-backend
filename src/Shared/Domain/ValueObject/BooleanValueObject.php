<?php

namespace App\Shared\Domain\ValueObject;

abstract class BooleanValueObject
{
    protected ?bool $value;

    public function __construct(?bool $value = null)
    {
        $this->value = $value;
        $this->validate();
    }

    public function getValue(): ?bool
    {
        return $this->value;
    }

    protected function validate(){ }
}
