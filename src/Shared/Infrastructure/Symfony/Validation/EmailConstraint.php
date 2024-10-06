<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

use Symfony\Component\Validator\Constraints as Assert;

class EmailConstraint
{
    public static function check(): array
    {
        return [
            new Assert\NotBlank(),
            new Assert\Type('string'),
            new Assert\Email([
                'message' => 'The email "{{ value }}" is not a valid email.',
            ]),
        ];
    }
}