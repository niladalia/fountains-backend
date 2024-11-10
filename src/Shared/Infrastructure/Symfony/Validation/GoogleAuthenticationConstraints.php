<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class GoogleAuthenticationConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'code' => self::type('string'),
        ];
    }
}
