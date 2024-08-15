<?php

namespace App\Shared\Domain\ValueObject;

abstract class ValueObject
{
    protected mixed $value;

    protected function __construct(mixed $value = null)
    {
        $this->value = $value;
        $this->validate();
    }

    protected function validate()
    {
        // Template (subclasses can override this method to add validation)
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function isPresent(): bool
    {
        return $this->value !== null;
    }
}
