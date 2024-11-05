<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Find\FountainsFinder;
use App\Fountains\Application\Find\Filter\BoundingBoxFilter;
use App\Fountains\Application\Find\Filter\FountainsFilterRequestBuilder;

use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\PaginateConstraints;
use App\Shared\Infrastructure\Symfony\Validation\BoundingBoxConstraints;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

class FountainsGetController extends ApiController
{
    public function __invoke(Request $request, FountainsFinder $fountainsFinder, UserInterface $userAdapter): Response
    {
        $queryParameters = $request->query->all();

        $this->validateParams($queryParameters);

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

        // We use a builder in order to handle multiple optional filters
        $fountainsFilterBuilder = (new FountainsFilterRequestBuilder())
           ->setLimit($limit)
           ->setOffset($offset);

        // We add the optional bbox filter into the builder
        $this->setBoundingBoxFilter($fountainsFilterBuilder, $queryParameters);


        $fountainsFinderRequest = $fountainsFilterBuilder->build();

        $fountains = $fountainsFinder->__invoke($fountainsFinderRequest);

        return new JsonResponse($fountains->toArray(), Response::HTTP_OK);
    }

    private function validateParams(array $queryParameters): void
    {
        //We validate the query params
        $this->validateRequest($queryParameters, $this->constraints());

        // We validate the optional BBox params
        if ($this->withBoundingBoxParameters($queryParameters)) {
            $this->validateRequest(
                $queryParameters,
                BoundingBoxConstraints::constraintsAllowExtraFields()
            );
        }

    }

    private function setBoundingBoxFilter(FountainsFilterRequestBuilder $fountainsFilter, array $queryParameters)
    {
        if ($this->withBoundingBoxParameters($queryParameters)) {
            $fountainsFilter->setBoundingBoxFilter(
                new BoundingBoxFilter(
                    $queryParameters['south_lat'],
                    $queryParameters['west_long'],
                    $queryParameters['north_lat'],
                    $queryParameters['east_long']
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
