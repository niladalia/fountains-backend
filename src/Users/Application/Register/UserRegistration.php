<?php

namespace App\Users\Application\Register;

use App\Users\Application\Create\DTO\CreateUserRequest;
use App\Users\Domain\PasswordHasherRepository;
use App\Users\Domain\User;
use App\Users\Domain\UserRepository;
use App\Users\Domain\ValueObject\UserEmail;
use App\Users\Domain\ValueObject\UserId;
use App\Users\Domain\ValueObject\UserPassword;

class RegistrateUser
{
    public function __construct(
        private UserRepository $userRepository,
        private PasswordHasherRepository $passwordHasher
    ) { }

    public function __invoke(CreateUserRequest $userRequest): void
    {
        $user = User::create(
            UserId::generate(),
            new UserEmail($userRequest->email()),
            new UserPassword(
                $this->passwordHasher->hash($userRequest->password())
            )
        );

        $this->userRepository->save($user);

    }
}