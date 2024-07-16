<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Find\Filter\FindFountainByFilter;
use App\Fountains\Application\Find\FountainsFinder;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Response;

class FountainsGetController extends ApiController
{
    public function __invoke(Request $request,  FountainsFinder $fountainsFinder): Response
    {
        $lat = $request->query->get('lat');
        $long = $request->query->get('long');

        $requestFountainsFinder = new FindFountainByFilter($lat, $long);

        $fountains = $fountainsFinder->__invoke($requestFountainsFinder);

        return new JsonResponse($fountains->toArray(), Response::HTTP_OK);
    }

    private function constraints(): Assert\Collection
    {

    }
}
