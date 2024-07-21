<?php

namespace App\Fountains\Application\Find\Filter;

use App\Fountains\Domain\BoundingBox;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;

class BoundingBoxFactory
{
    public static function fromBoundingBoxFilter(BoundingBoxFilter $bboxFilter) {
        return new BoundingBox(
            new FountainLat($bboxFilter->southLat()),
            new FountainLong($bboxFilter->westLong()),
            new FountainLat($bboxFilter->northLat()),
            new FountainLong($bboxFilter->eastLong())
        );
    }
}