<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class UserLoginConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'email' => EmailConstraint::check(),
            'password' => self::type('string'),
        ];
    }
}
