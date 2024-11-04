<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

use App\Fountains\Domain\ValueObject\FountainType;
use App\Fountains\Domain\ValueObject\FountainSafeWater;
use App\Fountains\Domain\ValueObject\FountainLegalWater;
use App\Fountains\Domain\ValueObject\FountainAccess;

class FountainConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'lat' => CoordinatesConstraints::latitude(),
            'long' => CoordinatesConstraints::longitude(),
            'name' => self::optional(self::type('string')),
            'type' => self::optional(self::enum(FountainType::class)),
            'picture' => self::optional(self::type('string')),
            'description' => self::optional(self::type('string')),
            'operational_status' => self::optional(self::type('bool')),
            'safe_water' => self::optional(self::enum(FountainSafeWater::class)),
            'legal_water' => self::optional(self::enum(FountainLegalWater::class)),
            'access_bottles' => self::optional(self::type('bool')),
            'access_pets' => self::optional(self::type('bool')),
            'access_wheelchair' => self::optional(self::type('bool')),
            'access' => self::optional(self::enum(FountainAccess::class)),
            'fee' => self::optional(self::type('bool')),
            'address' => self::optional(self::type('string'))
        ];
    }
}
