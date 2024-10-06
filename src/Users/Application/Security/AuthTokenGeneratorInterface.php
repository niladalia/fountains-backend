<?php

namespace App\Users\Infrastructure\Security;

interface AuthTokenGeneratorInterface
{
    public function generateToken(UserAdapter $userAdapter): string;
}