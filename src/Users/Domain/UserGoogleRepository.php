<?php

namespace App\Users\Domain;

use App\Users\Domain\ValueObject\UserEmail;

interface UserGoogleRepository
{
    public function saveGoogleAccount(string $userId, string $googleId): void;
    public function findGoogleId(string $userId): ?string;
}