<?php

namespace App\Providers\Infrastructure\Controllers;

use App\Providers\Application\Create\DTO\CreateProviderRequest;
use App\Providers\Application\Create\DTO\CreateProviderResponse;
use App\Providers\Application\Create\ProviderCreator;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\ProviderConstraints;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class ProvidersPostController extends ApiController
{
    public function __invoke(Request $request, ProviderCreator $providerCreator): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $this->validateRequest($requestData, $this->constraints());

        $providerRequest = new CreateProviderRequest(
            $requestData['name'],
            $requestData['url']
        );

        /** @var CreateProviderResponse $created */
        $creatorResponse = $providerCreator->__invoke($providerRequest);

        return new Response('', $creatorResponse->isCreated() ? Response::HTTP_CREATED : Response::HTTP_OK);
    }

    protected function constraints(): Assert\Collection
    {
        return ProviderConstraints::constraints();
    }

}
