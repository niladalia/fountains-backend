<?php

namespace App\Users\Domain;

use App\Users\Domain\ValueObject\UserEmail;

interface UserRepository
{
    public function findByEmail(UserEmail $email): ?User;
}