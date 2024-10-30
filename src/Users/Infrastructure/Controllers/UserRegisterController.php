<?php

namespace App\Users\Infrastructure\Controllers;

use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\UserRegistrationConstraints;
use App\Users\Application\Register\DTO\RegisterUserRequest;
use App\Users\Application\Register\UserRegistration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegisterController extends ApiController
{
    public function __invoke(Request $request, UserRegistration $userRegistration): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $this->validateRequest($requestData, $this->constraints());

        $userRegistration->__invoke(
            new RegisterUserRequest(
                $requestData['email'],
                $requestData['password'],
                $requestData['name']
            )
        );
        return new Response('', Response::HTTP_CREATED);
    }

    protected function constraints(): Assert\Collection
    {
        return UserRegistrationConstraints::constraints();
    }
}