<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class ProviderConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'name' => self::type('string'),
            'url' => self::optional(self::type('string'))
        ];
    }
}
