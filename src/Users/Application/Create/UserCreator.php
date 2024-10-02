<?php

namespace App\Users\Application\Create;

use App\Users\Domain\User;
use App\Users\Domain\UserRepository;
use App\Users\Domain\ValueObject\UserEmail;
use App\Users\Domain\ValueObject\UserId;
use App\Users\Domain\ValueObject\UserPassword;

class UserCreator
{
    public function __construct(private UserRepository $userRepository)
    {
    }
    public function __invoke(UserEmail $email, UserPassword $password): void
    {
        $user = User::create(
            UserId::generate(),
            $email,
            $password
        );

        $this->userRepository->save($user);

    }
}