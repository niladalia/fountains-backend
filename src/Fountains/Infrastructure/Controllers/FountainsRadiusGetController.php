<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Find\Filter\FindFountainsByRadiusRequest;
use App\Fountains\Application\Find\FountainsFinderByRadius;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\RadiusConstraints;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

class FountainsRadiusGetController extends ApiController
{
    public function __invoke(Request $request, FountainsFinderByRadius $fountainsRadiusFinder): Response
    {
        $queryParameters = $request->query->all();

        $this->validateRequest($queryParameters, $this->constraints());

        $fountainsRadiusFilter = new FindFountainsByRadiusRequest(
            $queryParameters['lat'],
            $queryParameters['long'],
            $queryParameters['radius']
        );

        $fountains = $fountainsRadiusFinder->__invoke($fountainsRadiusFilter);

        return new JsonResponse($fountains->toArray(), Response::HTTP_OK);
    }

    protected function constraints(): Assert\Collection
    {
        return RadiusConstraints::constraints();
    }
}
