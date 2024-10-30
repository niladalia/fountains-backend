<?php

namespace App\Fountains\Application\Delete\DTO;

class DeleteFountainRequest
{
    public function __construct(public string $id)
    { }

    public function id(): string
    {
        return $this->id;
    }
}