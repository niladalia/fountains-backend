<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Application\Find\DTO\FindFountainRequest;
use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\Services\FountainFinder as DomainFountainFinder;

class FountainFinder
{
    private $finder;

    public function __construct(DomainFountainFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(FindFountainRequest $findFountainRequest): Fountain
    {
        return $this->finder->__invoke(FountainId::fromString($findFountainRequest->getId()));
    }
}