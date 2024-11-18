<?php

namespace App\Users\Application\Find\DTO;

class FindUserResponse
{
    public function __construct(
        public string $id,
        private string $email,
        private array $fountains,
        private array $comments,
    ) {}

    public function id(): string
    {
        return $this->id;
    }
    public function email(): string
    {
        return $this->email;
    }

    public function fountains(): array
    {
        return $this->fountains;
    }

    public function comments(): array
    {
        return $this->comments;
    }

    public function data(): array
    {
        return [
            'id' => $this->id(),
            'email' => $this->email(),
            'fountains' => $this->fountains(),
            'comments' => $this->comments()
        ];
    }
}
