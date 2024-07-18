<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Find\FountainsFinder;
use App\Fountains\Application\Find\Filter\BoundingBoxFilter;
use App\Fountains\Application\Find\Filter\FountainsFilterBuilder;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            $limit = $queryParameters['limit'] ?? null;
            $offset = $queryParameters['offset'] ?? null;

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
            $this->validateRequest($queryParameters, $this->constraintsBoundingBox());

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

    private function constraints(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'fields' => [
                    'limit' => new Assert\Optional(new Assert\Type('int')),
                    'offset' => new Assert\Optional(new Assert\Type('int'))
                ]
            ]
        );
    }

    private function constraintsBoundingBox(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'fields' => [
                    'south_lat' => new Assert\Type('float'),
                    'west_long' => new Assert\Type('float'),
                    'north_lat' => new Assert\Type('float'),
                    'east_long' => new Assert\Type('float'),
                ],
                'allowExtraFields' => true
            ]
        );
    }
}
