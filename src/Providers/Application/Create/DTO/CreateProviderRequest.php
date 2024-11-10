<?php

namespace App\Providers\Application\Create\DTO;

class CreateProviderRequest
{
    public function __construct(
        private string $name,
        private ?string $url,
    ) {}

    public function name(): string
    {
        return $this->name;
    }

    public function url(): ?string
    {
        return $this->url;
    }
}
