<?php

namespace App\Tests\Providers\Domain;

use App\Providers\Domain\Provider;
use App\Providers\Domain\ValueObject\ProviderName;
use App\Providers\Domain\ValueObject\ProviderUrl;

class ProviderMother
{
    public static function create(
        ?ProviderName $name = null,
        ?ProviderUrl $url = null
    ):Provider {
        return new Provider(
            $name ?? ProviderNameMother::create(),
            $url ?? ProviderUrlMother::create()
        );
    }
}