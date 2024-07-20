<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class BoundingBoxConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'south_lat' => CoordinatesConstraints::latitude(),
            'west_long' => CoordinatesConstraints::longitude(),
            'north_lat' => CoordinatesConstraints::latitude(),
            'east_long' => CoordinatesConstraints::longitude()
        ];
    }
}
