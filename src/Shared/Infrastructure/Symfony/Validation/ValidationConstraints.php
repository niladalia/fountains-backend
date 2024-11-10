<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

use Symfony\Component\Validator\Constraints as Assert;

abstract class ValidationConstraints
{
    abstract protected function fields(): array;

    protected function fieldsConstraints(array $options): Assert\Collection
    {
        return new Assert\Collection(
            array_merge(
                [
                    'fields' => $this->fields(),
                ],
                $options,
            ),
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

    final protected static function enum(string $enumClass): EnumConstraint
    {
        return new EnumConstraint(['enum' => $enumClass]);
    }

    final protected static function type(string $type): Assert\Type
    {
        return new Assert\Type($type);
    }

    final protected static function optional(mixed $constraint): Assert\Optional
    {
        return new Assert\Optional($constraint);
    }

    final protected static function required(mixed $constraint): Assert\Required
    {
        return new Assert\Required($constraint);
    }
}
