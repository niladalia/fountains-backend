<?php

namespace App\Users\Application\Authenticate;

use App\Users\Application\Authenticate\DTO\GoogleAuthenticatorRequest;
use App\Users\Application\Create\UserCreator;
use App\Users\Domain\Auth\GoogleOAuthClientInterface;
use App\Users\Domain\UserRepository;
use App\Users\Domain\ValueObject\UserEmail;
use App\Users\Domain\ValueObject\UserGoogleAuthCode;
use App\Users\Domain\ValueObject\UserPassword;

class UserGoogleAuthenticator
{
    public function __construct(
        private UserRepository $userRepository,
        private GoogleOAuthClientInterface $googleOauth,
        private UserCreator $creator
    )
    { }

    public function __invoke(GoogleAuthenticatorRequest $request): void
    {
        $googleData = $this->googleOauth->fetchUserData(new UserGoogleAuthCode($request->code()));

        $user = $this->userRepository->findByEmail(new UserEmail($googleData->email()));

        if (!$user) {
            $this->creator->__invoke(
                new UserEmail($googleData->email()),
                new UserPassword()
            );
        }
    }
}