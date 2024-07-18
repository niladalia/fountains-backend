<?php

namespace App\Providers\Domain;

use App\Providers\Domain\ValueObject\ProviderName;
use App\Shared\Domain\Entity;

class Provider implements Entity
{

    public function __construct(private ProviderName $name) { }

    public static function create(
        ProviderName $name
    ): self {
        $provider = new self(
            $name
        );

        return $provider;
    }

    public function name(): ProviderName
    {
        return $this->name;
    }

    public function setName(ProviderName $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name()->getValue()
        ];
    }

}
