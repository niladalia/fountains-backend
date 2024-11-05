<?php

namespace App\Providers\Application\Create\DTO;

class CreateProviderResponse
{
    public function __construct(private bool $isCreated) {}

    public function isCreated(): bool
    {
        return $this->isCreated;
    }
}
