<?php

namespace App\Shared\Domain\ValueObject;

class UuidValueObject
{
    protected ?Uuid $value;

    public function __construct(?string $value = null)
    {
        if($value !== null) {
            $value = new Uuid($value);
        }
        $this->value = $value;

        $this->validate();
    }

    public function getValue(): ?Uuid
    {
        return $this->value;
    }

    protected function validate(){ }
}
