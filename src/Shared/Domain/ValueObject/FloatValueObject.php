<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;

abstract class FloatValueObject
{
    protected ?float $value;

    public function __construct(?float $value = null)
    {
        $this->value = $value;
        $this->validate();
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    protected function validate(){ }
}
