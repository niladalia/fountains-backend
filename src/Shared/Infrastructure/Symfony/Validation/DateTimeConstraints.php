<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

use Symfony\Component\Validator\Constraints as Assert;

abstract class DateTimeConstraints
{
    public static function dateTime(): array
    {
        return [
            new Assert\Type('string'),
            new Assert\DateTime(['format' => \DateTime::ATOM]),
        ];
    }
}
