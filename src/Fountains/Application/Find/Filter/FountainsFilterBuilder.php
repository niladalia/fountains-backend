<?php

namespace App\Fountains\Application\Find\Filter;

use App\Fountains\Domain\FountainsFilter;

class FountainsFilterBuilder
{
    private ?int $limit = null;
    private ?int $offset = null;

    private ?BoundingBoxFilter $boundingBoxFilter = null;

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }

    public function boundingBoxFilter(): ?BoundingBoxFilter
    {
        return $this->boundingBoxFilter;
    }

    public function setLimit(?int $limit): FountainsFilterBuilder
    {
        $this->limit = $limit;
        return $this;
    }

    public function setOffset(?int $offset): FountainsFilterBuilder
    {
        $this->offset = $offset;
        return $this;
    }

    public function setBoundingBoxFilter(?BoundingBoxFilter $boundingBoxFilter): FountainsFilterBuilder
    {
        $this->boundingBoxFilter = $boundingBoxFilter;
        return $this;
    }

    public function get(): FountainsFilter
    {
        return new FountainsFilter(
            $this->limit,
            $this->offset,
            $this->boundingBoxFilter?->toBoundingBox()
        );
    }
}
