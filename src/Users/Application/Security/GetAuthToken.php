<?php

namespace App\Users\Application\Security;

use App\Users\Application\Security\DTO\TokenGeneratorRequest;

class GetAuthToken
{
    public function __construct(private AuthTokenGeneratorInterface $tokenGenerator)
    {
    }

    public function __invoke(TokenGeneratorRequest $request): string
    {
        return $this->tokenGenerator->generateToken(
            new TokenGeneratorRequest(
                $request->id(),
                $request->email()
            )
        );
    }
}