<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class FountainUpdateConstraints extends FountainConstraints
{
    protected function fields(): array
    {
        $fields = parent::fields();

        return $fields;
    }
}
