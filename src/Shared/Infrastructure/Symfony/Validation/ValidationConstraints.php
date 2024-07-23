<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

use Symfony\Component\Validator\Constraints as Assert;

abstract class ValidationConstraints
{
    protected abstract function fields(): array;

    protected function fieldsConstraints(array $options): Assert\Collection
    {
        return new Assert\Collection(
            array_merge(
                [
                    'fields' => $this->fields(),
                ],
                $options
            )
        );
    }

    private function fieldsConstraintsAllowExtraFields(array $options): Assert\Collection
    {
        return $this->fieldsConstraints(array_merge($options, ['allowExtraFields' => true]));
    }

    public static function constraints(array $options = []): Assert\Collection
    {
        return (new static())->fieldsConstraints($options);
    }

    public static function constraintsAllowExtraFields(array $options = []): Assert\Collection
    {
        return (new static())->fieldsConstraintsAllowExtraFields($options);
    }

    protected static final function enum(string $enumClass): EnumConstraint
    {
        return new EnumConstraint(['enum' => $enumClass]);
    }

    protected static final function type(string $type): Assert\Type
    {
        return new Assert\Type($type);
    }

    protected static final function optional(mixed $constraint): Assert\Optional
    {
        return new Assert\Optional($constraint);
    }
}
