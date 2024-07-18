<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Domain\Fountains;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Application\Find\Filter\FountainsFilterBuilder;
use App\Fountains\Application\Find\Filter\BoundingBoxFilter;

class FountainsFinder
{
    public function __construct(private FountainRepository $fountainRepository) { }

    public function findAll(): Fountains
    {
        return $this->fountainRepository->findAll();
    }

    public function findByFilter(FountainsFilterBuilder $filter): Fountains
    {
        return $this->fountainRepository->findByFilter($filter->get());
    }

    public function findByBoundingBox(BoundingBoxFilter $filter): Fountains
    {
        return $this->fountainRepository->findByBoundingBox($filter->toBoundingBox());
    }
}