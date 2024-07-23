<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

use Symfony\Component\Validator\Constraint;

final class EnumConstraint extends Constraint
{
    public string $message = 'The value "{value}" is not a valid {enum} type.';
    public string $enum;

    public function getRequiredOptions(): array
    {
        return ['enum'];
    }

    public function getTargets(): string
    {
        return parent::PROPERTY_CONSTRAINT;
    }
}
