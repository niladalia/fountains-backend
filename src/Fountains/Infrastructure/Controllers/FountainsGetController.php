<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Find\FountainsFinder;
use App\Fountains\Application\Find\Filter\FountainsFilterBuilder;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Response;

class FountainsGetController extends ApiController
{
    public function __invoke(Request $request, FountainsFinder $fountainsFinder): Response
    {
        $queryParameters = $request->query->all();

        $this->validateRequest($queryParameters, $this->constraints());

        $limit = $queryParameters['limit'] ?? null;
        $offset = $queryParameters['offset'] ?? null;

        $fountainsFilter = (new FountainsFilterBuilder())
            ->setLimit($limit)
            ->setOffset($offset);

        $fountains = $fountainsFinder->findByFilter($fountainsFilter);

        return new JsonResponse($fountains->toArray(), Response::HTTP_OK);
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
}
