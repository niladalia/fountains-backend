<?php

namespace App\Users\Infrastructure\Security;

use Symfony\Component\Security\Core\User\UserInterface;

class UserAdapter implements UserInterface
{
    public function __construct(private string $id, private string $email) {}


    public static function create(string $id, string $email): self
    {
        return new self($id, $email);
    }

    public function getUserIdentifier(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->email; // Assuming email is the username
    }

    public function getRoles(): array
    {
        return [
            'ROLE_USER',
        ];
    }

    public function getSalt(): ?string
    {
        return null; // bcrypt/argon2 don't need a salt
    }

    public function eraseCredentials(): void
    {
        // If you have sensitive data, clear it here
    }
}
