<?php

namespace App\Fountains\Application\Find\Filter;

use App\Fountains\Domain\BoundingBox;
use App\Shared\Domain\ValueObject\CoordinatesLat;
use App\Shared\Domain\ValueObject\CoordinatesLong;

class BoundingBoxFactory
{
    public static function fromBoundingBoxFilter(BoundingBoxFilter $bboxFilter)
    {
        return new BoundingBox(
            new CoordinatesLat($bboxFilter->southLat()),
            new CoordinatesLong($bboxFilter->westLong()),
            new CoordinatesLat($bboxFilter->northLat()),
            new CoordinatesLong($bboxFilter->eastLong()),
        );
    }
}
