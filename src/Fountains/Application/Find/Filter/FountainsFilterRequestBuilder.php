<?php

namespace App\Fountains\Application\Find\Filter;

class FountainsFilterRequestBuilder
{
    private ?int $limit = null;
    private ?int $offset = null;

    private ?FindFountainsByBoundingBoxFilter $boundingBoxFilter = null;

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }

    public function boundingBoxFilter(): ?FindFountainsByBoundingBoxFilter
    {
        return $this->boundingBoxFilter;
    }

    public function setLimit(?int $limit): FountainsFilterRequestBuilder
    {
        $this->limit = $limit;
        return $this;
    }

    public function setOffset(?int $offset): FountainsFilterRequestBuilder
    {
        $this->offset = $offset;
        return $this;
    }

    public function setBoundingBoxFilter(?FindFountainsByBoundingBoxFilter $boundingBoxFilter): FountainsFilterRequestBuilder
    {
        $this->boundingBoxFilter = $boundingBoxFilter;
        return $this;
    }

    public function build(): FountainsFilterRequest
    {
        return new FountainsFilterRequest
        (
            $this->limit,
            $this->offset,
            $this->boundingBoxFilter
        );
    }
}
