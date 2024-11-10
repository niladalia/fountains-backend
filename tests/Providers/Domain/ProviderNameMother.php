<?php

namespace App\Tests\Providers\Domain;

use App\Providers\Domain\ValueObject\ProviderName;
use Faker\Factory;

class ProviderNameMother
{
    public static function create(?string $value = null): ProviderName
    {
        return new ProviderName($value ?? Factory::create()->text(50));
    }
}
