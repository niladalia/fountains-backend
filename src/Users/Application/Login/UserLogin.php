<?php

namespace App\Users\Application\Register;

use App\Users\Application\Create\DTO\CreateUserRequest;
use App\Users\Application\Create\UserCreator;
use App\Users\Application\Register\DTO\RegistrateUserRequest;
use App\Users\Domain\PasswordHasherRepository;
use App\Users\Domain\User;
use App\Users\Domain\UserRepository;
use App\Users\Domain\ValueObject\UserEmail;
use App\Users\Domain\ValueObject\UserId;
use App\Users\Domain\ValueObject\UserPassword;

class UserRegistration
{
    public function __construct(
        private UserCreator $userCreator
    ) { }

    public function __invoke(RegistrateUserRequest $registrationRequest): void
    {
        $this->userCreator->__invoke(
            new CreateUserRequest(
                $registrationRequest->email(),
                $registrationRequest->password(),
                $registrationRequest->name()
            )
        );
    }
}