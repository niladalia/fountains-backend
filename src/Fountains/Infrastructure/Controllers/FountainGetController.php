<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Find\DTO\FindFountainRequest;
use App\Fountains\Application\Find\FountainFinder;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\PaginateConstraints;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

class FountainGetController extends ApiController
{
    public function __invoke(string $id, FountainFinder $fountainFinder): Response
    {
        $findFountainRequest = new FindFountainRequest($id);

        $fountain = $fountainFinder->__invoke($findFountainRequest);

        return new JsonResponse($fountain->toArray(), Response::HTTP_OK);
    }

    protected function constraints(): Assert\Collection
    {
        return new Assert\Collection([]);
    }
}
