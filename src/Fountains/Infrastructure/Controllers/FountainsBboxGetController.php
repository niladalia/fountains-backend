<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Find\Filter\BoundingBoxFilter;
use App\Fountains\Application\Find\FountainsFinderByBbox;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\BoundingBoxConstraints;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

class FountainsBboxGetController extends ApiController
{
    public function __invoke(Request $request, FountainsFinderByBbox $fountainsBboxFinder): Response
    {
        $queryParameters = $request->query->all();

        $this->validateRequest($queryParameters, $this->constraints());

        $fountainsBboxFilter = new BoundingBoxFilter(
            $queryParameters['south_lat'],
            $queryParameters['west_long'],
            $queryParameters['north_lat'],
            $queryParameters['east_long'],
        );

        $fountains = $fountainsBboxFinder->__invoke($fountainsBboxFilter);

        return new JsonResponse($fountains->toArray(), Response::HTTP_OK);
    }

    protected function constraints(): Assert\Collection
    {
        return BoundingBoxConstraints::constraints();
    }
}
