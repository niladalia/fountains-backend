<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class UserRegistrationConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'email' => EmailConstraint::check(),
            'password' => self::type('string'),
            'name' => self::type('string'),
        ];
    }
}
