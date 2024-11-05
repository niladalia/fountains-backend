<?php

namespace App\Users\Infrastructure\Controllers;

use App\Shared\Infrastructure\Symfony\ApiController;
use App\Users\Application\Find\DTO\FindUserRequest;

use App\Users\Application\Find\DTO\FindUserResponse;
use Symfony\Component\Validator\Constraints as Assert;
use App\Users\Application\Find\UserFinder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;

class UserGetController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(UserInterface $user, UserFinder $finder)
    {
     /** @var FindUserResponse $userData */
     $userData = $finder->__invoke(
         new FindUserRequest($user->getUserIdentifier())
     );

     return new JsonResponse(
         $userData->data(),
         200
        );

    }

    protected function constraints(): Assert\Collection
    {
        return new Assert\Collection([ ]);
    }
}