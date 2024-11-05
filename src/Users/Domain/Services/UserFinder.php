<?php

namespace App\Users\Domain\Services;

use App\Users\Domain\Exception\UserNotExistException;
use App\Users\Domain\User;
use App\Users\Domain\UserRepository;
use App\Users\Domain\ValueObject\UserId;

class UserFinder
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(UserId $id): User
    {

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if(!$user){
            UserNotExistException::throw("User with id $id not found");
        }

        return $user;
    }
}