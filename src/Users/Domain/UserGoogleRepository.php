<?php

namespace App\Users\Domain;


interface UserGoogleRepository
{
    public function saveGoogleAccount(string $userId, string $googleId): void;
    public function findGoogleId(string $userId): ?string;
}