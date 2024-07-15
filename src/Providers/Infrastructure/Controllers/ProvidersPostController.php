<?php

namespace App\Providers\Infrastructure\Controllers;


use App\Providers\Application\Create\CreateProviderRequest;
use App\Providers\Application\Create\ProviderCreator;
use App\Providers\Domain\ValueObject\ProviderId;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProvidersPostController extends ApiController
{
    public function __invoke(Request $request,  ProviderCreator $providerCreator): Response
    {
        $request_data = json_decode($request->getContent(), true);

        $this->validateRequest($request_data, $this->constraints());

        $provider_request = new CreateProviderRequest(
            $request_data['name']
        );

        $providerCreator->__invoke($provider_request);

        return new Response('', Response::HTTP_CREATED);
    }

    private function constraints(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'fields' => [
                    'name' => new Assert\Type('string')
                ],
                'allowExtraFields' => false
            ]
        );
    }

}
