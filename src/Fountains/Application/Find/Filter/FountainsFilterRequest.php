<?php

namespace App\Fountains\Application\Find\Filter;

class FountainsFilterRequest
{
    public function __construct(
        private ?int $limit = null,
        private ?int $offset = null,
        private ?FindFountainsByBoundingBoxFilter $boundingBoxFilter = null
    ){ }

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }

    public function getBoundingBoxFilter(): ?FindFountainsByBoundingBoxFilter
    {
        return $this->boundingBoxFilter;
    }

}