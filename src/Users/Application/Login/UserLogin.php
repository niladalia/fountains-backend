<?php

namespace App\Users\Application\Login;

use App\Users\Application\Find\UserFinderByEmail;
use App\Users\Application\Login\DTO\LoginResponse;
use App\Users\Application\Login\DTO\LoginUserRequest;
use App\Users\Domain\Exception\UserNotExistException;
use App\Users\Domain\Exception\WrongPasswordException;
use App\Users\Domain\PasswordHasherRepository;
use App\Users\Domain\ValueObject\UserEmail;


class UserLogin
{
    public function __construct(
        private PasswordHasherRepository $passwordHasher,
        private UserFinderByEmail $finderByEmail

    ) { }

    public function __invoke(LoginUserRequest $registrationRequest): ?LoginResponse
    {

        $email = $registrationRequest->email();

        $user = $this->finderByEmail->__invoke(new UserEmail($email));

        if(!$user){
            UserNotExistException::throw("User with email $email doesn't exist.");
        }

        $hashedPassword = $user->hashedPassword();

        $givenPassword =  $registrationRequest->password();

        $success = $this->passwordHasher->verifyPassword($hashedPassword, $givenPassword);

        if(!$success){
            WrongPasswordException::throw($email);
        }

        return new LoginResponse(
            $user->id(),
            $user->email()
        );
    }
}