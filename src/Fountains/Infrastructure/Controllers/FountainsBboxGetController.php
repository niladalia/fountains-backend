<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Find\FountainsFinder;
use App\Fountains\Application\Find\Filter\BoundingBoxFilter;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Response;

class FountainsBboxGetController extends ApiController
{
    public function __invoke(Request $request, FountainsFinder $fountainsFinder): Response
    {
        $queryParameters = $request->query->all();

        $this->validateRequest($queryParameters, $this->constraints());

        $fountainsBboxFilter = new BoundingBoxFilter(
            $queryParameters['south_lat'],
            $queryParameters['west_long'],
            $queryParameters['north_lat'],
            $queryParameters['east_long']
        );

        $fountains = $fountainsFinder->findByBoundingBox($fountainsBboxFilter);

        return new JsonResponse($fountains->toArray(), Response::HTTP_OK);
    }

    private function constraints(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'fields' => [
                    'south_lat' => new Assert\Type('float'),
                    'west_long' => new Assert\Type('float'),
                    'north_lat' => new Assert\Type('float'),
                    'east_long' => new Assert\Type('float'),
                ]
            ]
        );
    }
}
