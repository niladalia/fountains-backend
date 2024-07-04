<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

class UuidValueObject extends ValueObject
{
    public function __construct(?string $value = null)
    {
        if ($value !== null) {
            $value = Uuid::fromString($value);
        }
        $this->value = $value;
    }

    public function getValue(): ?Uuid
    {
        return $this->value;
    }
}
