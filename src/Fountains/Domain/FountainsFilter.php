<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\BoundingBox;

class FountainsFilter
{
    public function __construct(
        private ?int $limit = null,
        private ?int $offset = null,
        private ?BoundingBox $boundingBox = null
    ) { }

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }

    public function boundingBox(): ?BoundingBox
    {
        return $this->boundingBox;
    }
}