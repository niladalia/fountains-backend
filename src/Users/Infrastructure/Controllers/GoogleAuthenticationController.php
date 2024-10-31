<?php

namespace App\Users\Infrastructure\Controllers;

use App\Shared\Infrastructure\Symfony\ApiController;
use App\Users\Application\Authenticate\DTO\UserCreatorRequest;
use App\Users\Application\Authenticate\UserGoogleAuthenticator;
use App\Shared\Infrastructure\Symfony\Validation\GoogleAuthenticationConstraints;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
class GoogleAuthenticationController extends ApiController
{
    public function __invoke(Request $request, UserGoogleAuthenticator $authenticator): Response
    {
        $queryParameters = $request->query->all();

        $this->validateRequest($queryParameters, $this->constraints());

        $authenticatorRequest = new UserCreatorRequest($queryParameters['code']);

        $authenticator->__invoke($authenticatorRequest);

        return new Response('', Response::HTTP_CREATED);


    }

    protected function constraints(): Assert\Collection
    {
        return GoogleAuthenticationConstraints::constraintsAllowExtraFields();
    }
}