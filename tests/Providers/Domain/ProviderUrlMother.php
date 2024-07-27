<?php

namespace App\Tests\Providers\Domain;

use App\Providers\Domain\ValueObject\ProviderUrl;
use Faker\Factory;

class ProviderUrlMother
{
    public static function create(?string $value = null): ProviderUrl
    {
        return new ProviderUrl($value ?? Factory::create()->text(50));
    }
}