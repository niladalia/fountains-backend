<?php

namespace App\Users\Application\Find\DTO;

class FindUserRequest
{
    public function __construct(
        private string $id,
    ) {}

    public function id(): string
    {
        return $this->id;
    }
}
