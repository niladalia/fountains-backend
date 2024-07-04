<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use DateTime;

abstract class DateTimeValueObject extends ValueObject
{
    public function __construct(?DateTime $value = null)
    {
        parent::__construct($value);
    }

    public function getValue(): ?DateTime
    {
        return $this->value;
    }

    public function formatISO(): ?string
    {
        return $this->value?->format(DateTime::ATOM);
    }
}
