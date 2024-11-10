<?php

namespace App\Users\Application;

class UserRequest
{
    public function __construct(
        private string $email,
        private string $password,
        private ?string $name = null,
    ) {}

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function name(): string
    {
        return $this->name;
    }



}
