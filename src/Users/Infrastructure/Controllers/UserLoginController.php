<?php

namespace App\Users\Infrastructure\Controllers;

use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\UserLoginConstraints;
use App\Users\Application\Login\DTO\LoginUserRequest;
use App\Users\Application\Login\UserLogin;
use App\Users\Application\Security\DTO\TokenGeneratorRequest;
use App\Users\Application\Security\GetAuthToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class UserLoginController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(Request $request, UserLogin $userLogin, GetAuthToken $getAuthToken): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $this->validateRequest($requestData, $this->constraints());

        $loginResponse = $userLogin->__invoke(
            new LoginUserRequest(
                $requestData['email'],
                $requestData['password'],
            ),
        );

        $token = $getAuthToken->__invoke(
            new TokenGeneratorRequest(
                $loginResponse->id(),
                $loginResponse->email(),
            ),
        );

        return $this->json(['token' => $token], Response::HTTP_OK);
    }


    protected function constraints(): Assert\Collection
    {
        return UserLoginConstraints::constraints();
    }
}
