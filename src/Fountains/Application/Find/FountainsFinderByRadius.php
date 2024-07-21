<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Application\Find\Filter\FindFountainsByRadiusRequest;

use App\Fountains\Domain\Fountains;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\RadiusFilter;

use App\Shared\Domain\ValueObject\CoordinatesLat;
use App\Shared\Domain\ValueObject\CoordinatesLong;

class FountainsFinderByRadius
{
    public function __construct(private FountainRepository $fountainRepository) { }

    public function __invoke(FindFountainsByRadiusRequest $filter): Fountains
    {
        return $this->fountainRepository->findByRadius(
            new RadiusFilter(
                new CoordinatesLat($filter->lat()),
                new CoordinatesLong($filter->long()),
                $filter->radius()
            )
        );
    }
}