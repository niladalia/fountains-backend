<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Find\FountainsFinder;
use App\Fountains\Application\Find\Filter\BoundingBoxFilter;
use App\Fountains\Application\Find\Filter\FountainsFilterBuilder;

use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\PaginateConstraints;
use App\Shared\Infrastructure\Symfony\Validation\BoundingBoxConstraints;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

class FountainsGetController extends ApiController
{
    public function __invoke(Request $request, FountainsFinder $fountainsFinder): Response
    {
        $queryParameters = $request->query->all();

        $this->validateRequest($queryParameters, $this->constraints());

        if (empty($queryParameters)) {
            $fountains = $fountainsFinder->findAll();
        } else {
            $limit = (int) $queryParameters['limit'] ?? null;
            $offset = (int) $queryParameters['offset'] ?? null;

            $fountainsFilter = (new FountainsFilterBuilder())
                ->setLimit($limit)
                ->setOffset($offset);
            
            $this->setBoundingBoxFilter($fountainsFilter, $queryParameters);

            $fountains = $fountainsFinder->findByFilter($fountainsFilter);
        }

        return new JsonResponse($fountains->toArray(), Response::HTTP_OK);
    }

    private function setBoundingBoxFilter(FountainsFilterBuilder $fountainsFilter, array $queryParameters)
    {
        if ($this->withBoundingBoxParameters($queryParameters)) {
            $this->validateRequest(
                $queryParameters,
                BoundingBoxConstraints::constraintsAllowExtraFields()
            );

            $fountainsFilter->setBoundingBoxFilter(
                new BoundingBoxFilter(
                    (float) $queryParameters['south_lat'],
                    (float) $queryParameters['west_long'],
                    (float) $queryParameters['north_lat'],
                    (float) $queryParameters['east_long']
                )
            );
        }
    }

    private function withBoundingBoxParameters(array $queryParameters): bool
    {
        return isset($queryParameters['south_lat'])
            || isset($queryParameters['west_long'])
            || isset($queryParameters['north_lat'])
            || isset($queryParameters['east_long']);
    }

    protected function constraints(): Assert\Collection
    {
        return PaginateConstraints::constraintsAllowExtraFields();
    }
}
