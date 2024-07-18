<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class UpdateFountainConstraints extends CreateFountainConstraints
{
    protected function fields(): array
    {
        return array_merge(
            [
                'id' => self::optional(self::type('string')),
            ],
            parent::fields(),
        );
    }
}
