<?php

namespace App\Shared\Domain\ValueObject;

use DateTime;

abstract class DateTimeValueObject
{
    protected ?DateTime $value;

    public function __construct(?DateTime $value = null)
    {
        $this->value = $value;
        $this->validate();
    }

    public function getValue(): ?DateTime
    {
        return $this->value;
    }

    protected function validate(){

    }
}
