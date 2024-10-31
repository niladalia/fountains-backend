<?php

namespace App\Users\Domain;

interface PasswordHasherRepository
{
    public function hash(string $plainPassword): string;

    public function verifyPassword(string $plainPassword, string $hashedPassword): bool;
}