<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Application\Find\Filter\FindFountainsByRadiusRequest;
use App\Fountains\Domain\Fountains;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\RadiusFilter;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

class FountainsFinderByRadius
{
    public function __construct(private FountainRepository $fountainRepository) { }

    public function __invoke(FindFountainsByRadiusRequest $filter): Fountains
    {
        return $this->fountainRepository->findByRadius(
            new RadiusFilter(
                new FountainLat($filter->lat()),
                new FountainLong($filter->long()),
                $filter->radius()
            )
        );
    }
}