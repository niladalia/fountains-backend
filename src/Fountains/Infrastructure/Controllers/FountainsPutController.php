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
    public function __invoke(Request $request,  FountainCreateOrUpdate $fountainCreateOrUpdate): Response
    {
        $request_batch = json_decode($request->getContent(), true);

        foreach ($request_batch as $request_data) {
            $this->validateRequest($request_data, $this->constraints());

            $providerUpdatedAt = $this->parseDateTime($request_data['provider_updated_at'] ?? null);
            $updatedAt = $this->parseDateTime($request_data['updated_at'] ?? null);

            $fountain_request = new CreateOrUpdateFountainRequest(
                $request_data['id'] ?? null,
                $request_data['lat'],
                $request_data['long'],
                $request_data['name'] ?? null,
                $request_data['safe_water'] ?? null,
                $request_data['legal_water'] ?? null,
                $request_data['type'] ?? null,
                $request_data['picture'] ?? null,
                $request_data['description'] ?? null,
                $request_data['operational_status'] ?? null,
                $request_data['access_bottles'] ?? null,
                $request_data['access_pets'] ?? null,
                $request_data['access_wheelchair'] ?? null,
                $request_data['provider_name'] ?? null,
                $request_data['provider_id'] ?? null,
                $request_data['user_id'] ?? null,
                $providerUpdatedAt,
                $updatedAt
            );

            $fountainCreateOrUpdate->__invoke($fountain_request);
        }

        return new Response('', Response::HTTP_CREATED);
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
