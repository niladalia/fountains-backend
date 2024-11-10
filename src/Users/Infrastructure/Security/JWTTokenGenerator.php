<?php

namespace App\Users\Infrastructure\Security;

use App\Users\Application\Security\AuthTokenGeneratorInterface;
use App\Users\Application\Security\DTO\TokenGeneratorRequest;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class JWTTokenGenerator implements AuthTokenGeneratorInterface
{
    public function __construct(private JWTTokenManagerInterface $jwtManager) {}

    public function generateToken(TokenGeneratorRequest $tokenRequest): string
    {
        $userAdapter = UserAdapter::create(
            $tokenRequest->id(),
            $tokenRequest->email(),
        );

        $payload = [
            'email' => $userAdapter->getUsername(),
            'roles' => $userAdapter->getRoles(),
            'sub' => $userAdapter->getUserIdentifier(),
        ];

        return $this->jwtManager->createFromPayload($userAdapter, $payload);
    }
}
