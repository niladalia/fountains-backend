<?php

namespace App\Users\Application\Login\DTO;

class LoginResponse
{
    public function __construct(
        private string $id,
        private string $email,
    ) {}

    public function email(): string
    {
        return $this->email;
    }

    public function id(): string
    {
        return $this->id;
    }
}
