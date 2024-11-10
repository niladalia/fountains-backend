<?php

namespace App\Fountains\Application\Find\DTO;

class FindFountainRequest
{
    public function __construct(private string $id) {}

    public function getId(): string
    {
        return $this->id;
    }

}
