<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Find\DTO\FindFountainRequest;
use App\Fountains\Application\Find\DTO\FountainResponse;
use App\Fountains\Application\Find\FountainFinder;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

class FountainGetController extends ApiController
{
    public function __invoke(string $id, FountainFinder $fountainFinder): Response
    {
        $findFountainRequest = new FindFountainRequest($id);
        /** @var FountainResponse $fountainResponse */
        $fountainResponse = $fountainFinder->__invoke($findFountainRequest);

        return new JsonResponse($fountainResponse->data(), Response::HTTP_OK);
    }

    protected function constraints(): Assert\Collection
    {
        return new Assert\Collection([]);
    }
}
