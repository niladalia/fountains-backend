<?php

namespace App\Providers\Domain;

use App\Providers\Domain\ValueObject\ProviderName;

class Provider
{

    public function __construct(
        private ProviderName $name
    )
    { }

    public static function create(
        ProviderName $name
    ): self {
        $product = new self(
            $name
        );

        return $product;
    }

    public function getName(): ProviderName
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
            "name" => $this->getName()->getValue()
        ];
    }

}
