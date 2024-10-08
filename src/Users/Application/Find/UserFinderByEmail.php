<?php

namespace App\Users\Application\Find;

use App\Users\Domain\Exception\UserNotExistException;
use App\Users\Domain\User;
use App\Users\Domain\UserRepository;
use App\Users\Domain\ValueObject\UserEmail;

class UserFinderByEmail
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(UserEmail $email): User
    {
        $user =  $this->userRepository->findByEmail($email);

        if(!$user){
            UserNotExistException::throw("User with email $email not found");
        }

        return $user;
    }
}