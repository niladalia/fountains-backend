<?php

namespace App\Fountains\Infrastructure\Persistence\Doctrine\Filter;

use App\Fountains\Domain\BoundingBox;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;

class DoctrineFindFountainsByBoundingBox
{
    const BOUNDING_BOX_FILTER = 'geo_point::geometry && ST_MakeEnvelope(:west_long, :south_lat, :east_long, :north_lat, 4326)';

    private ?Statement $filterByBoundingBoxStatement = null;

    public function __construct(private Connection $connection) { }

    public function filterByBoundingBox(BoundingBox $boundingBox): Statement
    {
        if ($this->filterByBoundingBoxStatement === null || !$this->connection->isConnected()) {
            $this->prepareFilterByBoundingBoxStatement();
        }
        return self::bindBoundingBox($this->filterByBoundingBoxStatement, $boundingBox);
    }

    private function prepareFilterByBoundingBoxStatement(): void
    {
        $query = DoctrineFindFountainsByFilter::SELECT_FOUNTAINS . ' WHERE ' . self::BOUNDING_BOX_FILTER;
        
        $this->filterByBoundingBoxStatement = $this->connection->prepare($query);
    }

    static function bindBoundingBox(Statement $stmt, BoundingBox $boundingBox): Statement
    {
        $stmt->bindValue('west_long', $boundingBox->westLong()->getValue());
        $stmt->bindValue('south_lat', $boundingBox->southLat()->getValue());
        $stmt->bindValue('east_long', $boundingBox->eastLong()->getValue());
        $stmt->bindValue('north_lat', $boundingBox->northLat()->getValue());
        return $stmt;
    }
}
