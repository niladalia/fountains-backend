<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Domain\Fountains;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Application\Find\Filter\FountainsFilterBuilder;
use App\Fountains\Application\Find\Filter\BoundingBoxFilter;

class FountainsFinderByBbox
{
    public function __construct(private FountainRepository $fountainRepository) { }

    public function __invoke(BoundingBoxFilter $filter): Fountains
    {
        return $this->fountainRepository->findByBoundingBox($filter->toBoundingBox());
    }
}