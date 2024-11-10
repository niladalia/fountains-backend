<?php

namespace App\Fountains\Infrastructure\Persistence\Doctrine\Filter;

use App\Fountains\Domain\BoundingBox;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;

class FindFountainsByBoundingBox
{
    public const BOUNDING_BOX_FILTER = 'geo_point::geometry && ST_MakeEnvelope(:west_long, :south_lat, :east_long, :north_lat, 4326)';


    public function __construct(private Connection $connection) {}

    public function filter(BoundingBox $boundingBox): Statement
    {

        $query = FindFountainsByFilter::SELECT_FOUNTAINS . ' WHERE ' . self::BOUNDING_BOX_FILTER;

        $filterByBoundingBoxStatement = $this->connection->prepare($query);

        return self::bindBoundingBox($filterByBoundingBoxStatement, $boundingBox);
    }

    public static function bindBoundingBox(Statement $stmt, BoundingBox $boundingBox): Statement
    {
        $stmt->bindValue('west_long', $boundingBox->westLong()->getValue());
        $stmt->bindValue('south_lat', $boundingBox->southLat()->getValue());
        $stmt->bindValue('east_long', $boundingBox->eastLong()->getValue());
        $stmt->bindValue('north_lat', $boundingBox->northLat()->getValue());
        return $stmt;
    }
}
