<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Find\FountainsFinder;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FountainsGetController extends ApiController
{
    public function __invoke(Request $request,  FountainsFinder $fountainsFinder): Response
    {
        $fountains = $fountainsFinder->__invoke();

        return new JsonResponse($fountains->toArray(), Response::HTTP_CREATED);
    }
}
