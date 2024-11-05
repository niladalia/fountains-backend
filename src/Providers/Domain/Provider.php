<?php

namespace App\Providers\Domain;

use App\Providers\Domain\ValueObject\ProviderName;
use App\Providers\Domain\ValueObject\ProviderUrl;
use App\Shared\Domain\AggregateRoot;

class Provider extends AggregateRoot
{
    public function __construct(
        private ProviderName $name,
        private ProviderUrl $url
    ) { }

    public static function create(
        ProviderName $name,
        ProviderUrl $url,
    ): self {
        $provider = new self(
            $name,
            $url
        );

        return $provider;
    }

    public function name(): ProviderName
    {
        return $this->name;
    }

    public function url(): ProviderUrl
    {
        return $this->url;
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name()->getValue(),
            "url"  => $this->url()->getValue(),
        ];
    }
}
