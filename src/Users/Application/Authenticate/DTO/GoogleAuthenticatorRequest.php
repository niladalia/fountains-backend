<?php

namespace App\Users\Application\Authenticate\DTO;

class GoogleAuthenticatorRequest
{
    public function __construct(private string $code) {}

    public function code(): string
    {
        return $this->code;
    }

}
