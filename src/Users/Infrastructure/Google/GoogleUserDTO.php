<?php

namespace App\Users\Infrastructure\Google;

class GoogleUserDTO
{
    public function __construct(
        private string $googleId,
        private string $email,
        private string $name

    )
    { }

    public function googleId(): string
    {
        return $this->googleId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string{
        return $this->email;
    }
}