<?php

namespace App\Fountains\Infrastructure\Persistence\Doctrine\Filter;

use App\Fountains\Domain\FountainsFilter;

use Doctrine\DBAL\Statement;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;

class DoctrineFindFountainsByFilter
{
    const SELECT_FOUNTAINS = 'SELECT * FROM fountains';

    public function __construct(private Connection $connection) { }

    public function filter(FountainsFilter $filter): Statement
    {
        $select = self::SELECT_FOUNTAINS;

        $conditions = [];

        $boundingBox = $filter->boundingBox();

        if ($boundingBox !== null) {
            $conditions[] = DoctrineFindFountainsByBoundingBox::BOUNDING_BOX_FILTER;
        }

        $where = empty($conditions) ? '' : ' WHERE ' . join(' AND ', $conditions);

        $query = $select . $where;

        $limit = $filter->limit();

        if ($limit !== null) {
            $query .= ' LIMIT :limit';
        }

        $offset = $filter->offset();

        if ($offset !== null) {
            $query .= ' OFFSET :offset';
        }

        $stmt = $this->connection->prepare($query);

        if ($boundingBox !== null) {
            DoctrineFindFountainsByBoundingBox::bindBoundingBox($stmt, $boundingBox);
        }

        if ($limit !== null) {
            $stmt->bindValue('limit', $limit, ParameterType::INTEGER);
        }

        if ($offset !== null) {
            $stmt->bindValue('offset', $offset, ParameterType::INTEGER);
        }

        return $stmt;
    }
}
