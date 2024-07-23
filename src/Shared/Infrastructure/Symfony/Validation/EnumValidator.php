<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class EnumValidator extends ConstraintValidator
{
    private static array $enumValues = [];

    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof EnumConstraint) {
            throw new UnexpectedTypeException($constraint, EnumConstraint::class);
        }

        if ($value === null) {
            return;
        }

        $enumClass = $constraint->enum;

        if (!isset(self::$enumValues[$enumClass])) {
            if (!enum_exists($enumClass)) {
                throw new UnexpectedValueException($enumClass, 'enum class');
            }
            self::$enumValues[$enumClass] = array_map(fn($enum) => $enum->value, $enumClass::cases());
        }

        $validValues = self::$enumValues[$enumClass];

        if (!in_array($value, $validValues, true)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{value}', $value)
                ->setParameter('{enum}', $enumClass)
                ->addViolation();
        }
    }
}
