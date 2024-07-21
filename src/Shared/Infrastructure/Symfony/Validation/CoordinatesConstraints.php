<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

use Symfony\Component\Validator\Constraints as Assert;

abstract class CoordinatesConstraints
{
    public static function latitude(): array
    {
        return [
            new Assert\NotBlank(),
            new Assert\Type('numeric'),
            new Assert\Range(['min' => -90, 'max' => 90])
        ];
    }

    public static function longitude(): array
    {
        return [
            new Assert\NotBlank(),
            new Assert\Type('numeric'),
            new Assert\Range(['min' => -180, 'max' => 180])
        ];
    }
}
