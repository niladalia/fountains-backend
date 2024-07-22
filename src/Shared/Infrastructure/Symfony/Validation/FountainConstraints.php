<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class FountainConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'lat' => CoordinatesConstraints::latitude(),
            'long' => CoordinatesConstraints::longitude(),
            'name' => self::optional(self::type('string')),
            'type' => self::optional(self::type('string')),
            'picture' => self::optional(self::type('string')),
            'description' => self::optional(self::type('string')),
            'operational_status' => self::optional(self::type('bool')),
            'safe_water' => self::optional(self::type('string')),
            'legal_water' => self::optional(self::type('string')),
            'access_bottles' => self::optional(self::type('bool')),
            'access_pets' => self::optional(self::type('bool')),
            'access_wheelchair' => self::optional(self::type('bool')),
            'provider_name' => self::optional(self::type('string')),
            'provider_id' => self::optional(self::type('string')),
            'user_id' => self::optional(self::type('string')),
            'provider_updated_at' => self::optional(DateTimeConstraints::dateTime()),
        ];
    }
}
