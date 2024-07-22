<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\CreateOrUpdate\DTO\CreateOrUpdateFountainRequest;
use App\Fountains\Application\CreateOrUpdate\FountainCreateOrUpdateMany;

use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\FountainConstraints;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class FountainsPutController extends ApiController
{
    public function __invoke(Request $request, FountainCreateOrUpdateMany $fountainCreateOrUpdate): Response
    {
        $requestBatch = json_decode($request->getContent(), true);

        $validationConstraints = $this->constraints();

        $fountainRequests = array_map(function ($requestData) use ($validationConstraints) {
            $this->validateRequest($requestData, $validationConstraints);

            $providerUpdatedAt = $this->parseDateTime($requestData['provider_updated_at'] ?? null);

            return new CreateOrUpdateFountainRequest(
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
                $requestData['provider_name'] ?? null,
                $requestData['provider_id'] ?? null,
                $requestData['user_id'] ?? null,
                $providerUpdatedAt
            );
        }, $requestBatch);

        $fountainCreateOrUpdate->__invoke($fountainRequests);

        return new Response('', Response::HTTP_OK);
    }

    protected function constraints(): Assert\Collection
    {
        return FountainConstraints::constraintsAllowExtraFields();
    }

}
