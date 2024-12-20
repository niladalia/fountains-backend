<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Create\DTO\CreateFountainRequest;
use App\Fountains\Application\Create\FountainCreator;
use App\Shared\Domain\Utils\DateTimeUtils;
use App\Shared\Domain\Utils\Uuid;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\FountainCreateConstraints;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class FountainsPostController extends ApiController
{
    public function __invoke(Request $request, FountainCreator $fountainCreator): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $this->validateRequest($requestData, $this->constraints());

        $providerUpdatedAt = DateTimeUtils::parseDateTime(($requestData['provider_updated_at'] ?? null));
        $createFountainRequest = new CreateFountainRequest(
            Uuid::generate()->getValue(),
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
            $requestData['address'] ?? null,
            $requestData['website'] ?? null,
            $requestData['provider_name'] ?? null,
            $requestData['provider_id'] ?? null,
            $providerUpdatedAt,
            $requestData['provider_url'] ?? null,
            $requestData['user_id'] ?? null,
        );

        $fountainCreator->__invoke($createFountainRequest);

        return new Response('', Response::HTTP_CREATED);
    }

    protected function constraints(): Assert\Collection
    {
        return FountainCreateConstraints::constraints();
    }

}
