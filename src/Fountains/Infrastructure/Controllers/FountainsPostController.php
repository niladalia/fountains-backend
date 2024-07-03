<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Create\CreateFountainRequest;
use App\Fountains\Application\Create\FountainCreator;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FountainsPostController extends ApiController
{
    public function __invoke(Request $request,  FountainCreator $fountainCreator): Response
    {
        $request_data = json_decode($request->getContent(), true);

        $this->validateRequest($request_data, $this->constraints());

        $providerUpdatedAt = $this->parseDateTime($request_data['provider_updated_at'] ?? null);

        $fountain_request = new CreateFountainRequest(
            $request_data['lat'],
            $request_data['long'],
            $request_data['name'] ?? null,
            $request_data['fountain_type'] ?? null,
            $request_data['picture'] ?? null,
            $request_data['description'] ?? null,
            $request_data['operational_status'] ?? null,
            $request_data['safe_water'] ?? null,
            $request_data['legal_water'] ?? null,
            $request_data['access_bottles'] ?? null,
            $request_data['access_pets'] ?? null,
            $request_data['access_wheelchair'] ?? null,
            $request_data['provider_name'] ?? null,
            $request_data['provider_id'] ?? null,
            $request_data['user_id'] ?? null,
            $providerUpdatedAt
        );

        $fountainCreator->__invoke($fountain_request);

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
