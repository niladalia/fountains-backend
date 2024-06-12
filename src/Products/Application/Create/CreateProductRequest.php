<?php

namespace App\Products\Application\Create;

class CreateProductRequest
{
    public function __construct(
        private ?string $id = null,
        private ?string $name = null
    ) {}


    public function id(): ?string
    {
        return $this->id;
    }
    public function name(): ?string
    {
        return $this->name;
    }

}