<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Update\DTO\UpdateFountainRequest;
use App\Fountains\Application\Update\FountainUpdater;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\FountainUpdateConstraints;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class FountainsPatchController extends ApiController
{
    public function __invoke(Request $request, string $id, FountainUpdater $fountainUpdate): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $validationConstraints = $this->constraints();

        $this->validateRequest($requestData, $validationConstraints);

        $fountainRequest =  new UpdateFountainRequest(
            $id,
            $requestData['lat'],
            $requestData['long'],
            $requestData['name'] ?? null,
            $requestData['type'] ?? null,
            $requestData['picture'] ?? null,
            $requestData['description'] ?? null,
            $requestData['operational_status'] ?? null,
            $requestData['safe_water'] ?? null,
            $requestData['legal_water'] ?? null,
            $requestData['access_bottles'] ?? null,
            $requestData['access_pets'] ?? null,
            $requestData['access_wheelchair'] ?? null,
            $requestData['access'] ?? null,
            $requestData['fee'] ?? null,
            $requestData['address'] ?? null
        );

        $fountainUpdate->__invoke($fountainRequest);

        return new Response('', Response::HTTP_OK);
    }

    protected function constraints(): Assert\Collection
    {
        return FountainUpdateConstraints::constraints();
    }

}
