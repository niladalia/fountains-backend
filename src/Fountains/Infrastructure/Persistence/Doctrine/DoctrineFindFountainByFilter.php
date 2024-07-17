<?php

namespace App\Fountains\Infrastructure\Persistence\Doctrine;

use App\Fountains\Domain\FountainFilter;
use Doctrine\DBAL\Statement;
use Doctrine\ORM\QueryBuilder;
use Doctrine\DBAL\Connection;

class DoctrineFindFountainByFilter
{
    public static function filter(Connection $connection, FountainFilter $filter): Statement
    {
        $lat = $filter->lat() ? $filter->lat()->getValue() : null;
        $long = $filter->long() ? $filter->long()->getValue() : null;

        $offset = $filter->offset();
        $limit = $filter->limit();

        $query = "SELECT * FROM fountains WHERE 1=1";
        if ($lat !== null && $long !== null) {
            $westLong = $long;
            $southLat = $lat;
            $eastLong = $long;
            $northLat = $lat;

            $query .= " AND geo_point::geometry && ST_MakeEnvelope( :west_long, :south_lat, :east_long, :north_lat, 4326)";
        }

        $query .= " LIMIT :limit OFFSET :offset";

        $stmt = $connection->prepare($query);

        if ($lat !== null && $long !== null) {
            $stmt->bindValue('west_long', $westLong);
            $stmt->bindValue('south_lat', $southLat);
            $stmt->bindValue('east_long', $eastLong);
            $stmt->bindValue('north_lat', $northLat);
        }

        $stmt->bindValue('limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, \PDO::PARAM_INT);

        return $stmt;
    }
}

