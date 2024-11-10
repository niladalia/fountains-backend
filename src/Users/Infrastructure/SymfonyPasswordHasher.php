<?php

namespace App\Users\Infrastructure;

use App\Users\Domain\PasswordHasherRepository;
use App\Users\Domain\User;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class SymfonyPasswordHasher implements PasswordHasherRepository
{
    private $hasher;

    public function __construct(PasswordHasherFactoryInterface $passwordHasher)
    {
        $this->hasher = $passwordHasher->getPasswordHasher(User::class);

    }

    public function hash(string $plainPassword): string
    {
        return $this->hasher->hash($plainPassword);
    }

    public function verifyPassword(string $hashedPassword, string $plainPassword): bool
    {
        return $this->hasher->verify($hashedPassword, $plainPassword);
    }
}
