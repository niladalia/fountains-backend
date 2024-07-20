<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

class FountainFinderByLocation
{
    public function __construct(private FountainRepository $fountainRepository) { }

    public function __invoke(FountainLat $lat, FountainLong $long): ?Fountain
    {
        return $this->fountainRepository->findByLocation($lat, $long);
    }
}