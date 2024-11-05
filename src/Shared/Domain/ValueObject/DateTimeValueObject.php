<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use DateTime;

abstract class DateTimeValueObject
{
    public function __construct(protected ?DateTime $value = null) {}

    public function getValue(): ?DateTime
    {
        return $this->value;
    }

    public function formatISO(): ?string
    {
        return $this->value?->format(DateTime::ATOM);
    }
}
