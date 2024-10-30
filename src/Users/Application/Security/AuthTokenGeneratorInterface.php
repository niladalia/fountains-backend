<?php

namespace App\Users\Application\Security;

use App\Users\Application\Security\DTO\TokenGeneratorRequest;

interface AuthTokenGeneratorInterface
{
    public function generateToken(TokenGeneratorRequest $tokenRequest): string;
}