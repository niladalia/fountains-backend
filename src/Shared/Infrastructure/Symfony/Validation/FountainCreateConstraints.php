<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class FountainCreateConstraints extends FountainConstraints
{
    protected function fields(): array
    {
        $fields = parent::fields();

        $fields['website'] = self::optional(self::type('string'));
        $fields['provider_name'] = self::optional(self::type('string'));
        $fields['provider_id'] = self::optional(self::type('string'));
        $fields['provider_updated_at'] = self::optional(DateTimeConstraints::dateTime());
        $fields['provider_url'] = self::optional(self::type('string'));
        $fields['user_id'] = self::optional(self::type('string'));

        return $fields;
    }
}
