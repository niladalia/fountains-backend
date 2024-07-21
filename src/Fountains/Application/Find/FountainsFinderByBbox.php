<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Application\Find\Filter\BoundingBoxFactory;
use App\Fountains\Domain\Fountains;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Application\Find\Filter\FindFountainsByBoundingBoxFilter;

class FountainsFinderByBbox
{
    public function __construct(private FountainRepository $fountainRepository) { }

    public function __invoke(FindFountainsByBoundingBoxFilter $filter): Fountains
    {
        return $this->fountainRepository->findByBoundingBox(BoundingBoxFactory::fromBoundingBoxFilter($filter));
    }
}