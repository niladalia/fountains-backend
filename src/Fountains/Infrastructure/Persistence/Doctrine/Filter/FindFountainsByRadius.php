<?php

namespace App\Fountains\Infrastructure\Persistence\Doctrine\Filter;

use App\Fountains\Domain\RadiusFilter;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;

class FindFountainsByRadius
{
    const RADIUS_FILTER = 'ST_DWithin( ST_Transform(geo_point::geometry, 3857), ST_Transform(ST_SetSRID(ST_MakePoint(:long, :lat), 4326)::geometry, 3857), :radius);';

    public function __construct(private Connection $connection) { }

    public function filter(RadiusFilter $radiusFilter): Statement
    {
        $query = FindFountainsByFilter::SELECT_FOUNTAINS . ' WHERE ' . self::RADIUS_FILTER;

        $filterByRadiusStatement = $this->connection->prepare($query);

        return self::bindRadius($filterByRadiusStatement, $radiusFilter);
    }

    static function bindRadius(Statement $stmt, RadiusFilter $radiusFilter): Statement
    {
        $stmt->bindValue('long', $radiusFilter->long()->getValue());
        $stmt->bindValue('lat', $radiusFilter->lat()->getValue());
        $stmt->bindValue('radius', $radiusFilter->radius());
        return $stmt;
    }
}
