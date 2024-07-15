<?php

namespace App\Providers\Application\Create;

class CreateProviderRequest
{
    public function __construct(private string $name) {}

    public function name():string {
        return $this->name;
    }
}