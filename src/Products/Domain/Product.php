<?php

namespace App\Products\Domain;

use App\Products\Domain\ValueObject\ProductId;
use App\Products\Domain\ValueObject\ProductName;

class Product
{

    public function __construct(private ProductId $id, private ?ProductName $name)
    {
    }

    public static function create(
        ProductId $id,
        ProductName $name
    ): self {
        $product = new self(
            $id,
            $name
        );

        return $product;
    }

    public function getId(): ?ProductId
    {
        return $this->id;
    }

    public function getName(): ?ProductName
    {
        return $this->name;
    }

    public function setName(?ProductName $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->getId()->getValue(),
            "name" => $this->getName()->getValue()
        ];
    }

}
