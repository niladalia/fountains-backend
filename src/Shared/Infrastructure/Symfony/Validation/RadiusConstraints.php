<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

use Symfony\Component\Validator\Constraints as Assert;

class RadiusConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'lat' => CoordinatesConstraints::latitude(),
            'long' => CoordinatesConstraints::longitude(),
            'radius' => $this->radius(),
        ];
    }

    private function radius(): array
    {
        return [
            new Assert\NotBlank(),
            new Assert\Type('numeric'),
            new Assert\Range(['min' => 0]),
        ];
    }
}
