<?php

namespace App\Users\Infrastructure\Security;

use App\Users\Domain\Exception\UserNotExistException;
use App\Users\Domain\User;
use App\Users\Domain\UserRepository;
use App\Users\Domain\ValueObject\UserEmail;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CustomUserProvider implements UserProviderInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findByEmail(new UserEmail($identifier));
        return UserAdapter::create($user->id(), $user->email());
    }
    public function loadUserByUsername($username): UserInterface
    {
        $user = $this->userRepository->findByEmail($username);

        if (!$user) {
            UserNotExistException::throw("User not found");
        }

        return UserAdapter::create($user->id(), $user->email());
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        // Normally you'd refresh the user from the database, but since we're using JWTs, we don't need to refresh
        // because the token is stateless. You can return the same user or throw an exception if necessary.
        return $user;
    }

    public function supportsClass($class): bool
    {
        // Check if the class is supported by this provider
        return UserAdapter::class === $class || User::class === $class;
    }
}
