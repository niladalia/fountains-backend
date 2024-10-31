<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Utils\Uuid;

class UuidValueObject extends ValueObject implements \Stringable
{
    public function __construct(?Uuid $value = null)
    {
        parent::__construct($value);

        $this->value = $value;
    }

    public function getValue(): ?Uuid
    {
        return $this->value;
    }


    function __tostring(): string
    {
        return $this->getValue()?->getValue() ?? '';
    }
}
