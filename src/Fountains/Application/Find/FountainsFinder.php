<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Application\Find\Filter\BoundingBoxFactory;
use App\Fountains\Application\Find\Filter\FountainsFilterRequest;
use App\Fountains\Domain\Fountains;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\FountainsFilter;

class FountainsFinder
{
    public function __construct(private FountainRepository $fountainRepository) { }

    public function __invoke(FountainsFilterRequest $filterRequest): Fountains
    {
        $bboxFilter = $filterRequest->getBoundingBoxFilter();

        $boundingBox = $bboxFilter ? BoundingBoxFactory::fromBoundingBoxFilter($bboxFilter) : null;

        $filter = new FountainsFilter(
            $filterRequest->limit(),
            $filterRequest->offset(),
            $boundingBox
        );
        return $this->fountainRepository->findByFilter($filter);
    }
}