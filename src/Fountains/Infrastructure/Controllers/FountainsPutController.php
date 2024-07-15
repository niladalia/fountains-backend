<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\CreateOrUpdate\CreateOrUpdateFountainRequest;
use App\Fountains\Application\CreateOrUpdate\FountainCreateOrUpdate;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FountainsPutController extends ApiController
{
    public function __construct(
        private FountainCreateOrUpdate $fountainCreateOrUpdate
    ) {}

    public function __invoke(Request $request): Response
    {
        $requestBatch = json_decode($request->getContent(), true);

        $validationConstraints = $this->constraints();

        $fountainRequests = array_map(function ($requestData) use ($validationConstraints) {
            $this->validateRequest($requestData, $validationConstraints);

            $providerUpdatedAt = $this->parseDateTime($requestData['provider_updated_at'] ?? null);

            return new CreateOrUpdateFountainRequest(
                $requestData['id'] ?? null,
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

        $this->fountainCreateOrUpdate->many($fountainRequests);

        return new Response('', Response::HTTP_OK);
    }

    private function constraints(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'fields' => [
                    'lat' => new Assert\Type('float'),
                    'long' => new Assert\Type('float')
                ],
                'allowExtraFields' => true
            ]
        );
    }

}
