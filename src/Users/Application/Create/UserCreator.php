<?php

namespace App\Users\Application\Create;

use App\Shared\Domain\Event\EventBus;
use App\Users\Application\Create\DTO\CreateUserRequest;
use App\Users\Domain\PasswordHasherRepository;
use App\Users\Domain\UniqueEmailSpecificationInterface;
use App\Users\Domain\User;
use App\Users\Domain\UserRepository;
use App\Users\Domain\ValueObject\UserEmail;
use App\Users\Domain\ValueObject\UserId;
use App\Users\Domain\ValueObject\UserPassword;

class UserCreator
{
    public function __construct(
        private UserRepository $userRepository,
        private UniqueEmailSpecificationInterface $uniqueEmailSpecification,
        private PasswordHasherRepository $passwordHasher,
        private EventBus $eventBus,
    ) {}

    public function __invoke(CreateUserRequest $userRequest): void
    {
        $user = User::create(
            UserId::generate(),
            new UserEmail($userRequest->email()),
            new UserPassword(
                $this->passwordHasher->hash($userRequest->password()),
            ),
            $this->uniqueEmailSpecification,
        );

        $this->userRepository->save($user);

        $this->eventBus->publish(...$user->pullDomainEvents());

    }
}
