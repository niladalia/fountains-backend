<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class UserLoginConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'email' => self::type('string'),
            'password' => self::type('string'),
            'name' => self::type('string')
        ];
    }
}
