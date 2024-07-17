<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Application\Find\Filter\FindFountainByFilter;
use App\Fountains\Domain\FountainFilter;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\Fountains;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

class FountainsFinder
{
    private $fountainRepository;

    public function __construct(FountainRepository $fountainRepository)
    {
        $this->fountainRepository = $fountainRepository;
    }

    public function __invoke(FindFountainByFilter $filter): ?Fountains
    {
        $lat = $filter->lat() !== null ? new FountainLat($filter->lat()) : null;
        $long = $filter->long() !== null ? new FountainLong($filter->long()) : null;

        return $this->fountainRepository->findByFilter(
            new FountainFilter(
                $lat,
                $long,
                $filter->limit(),
                $filter->offset()
            )
        );
    }
}