<?php

namespace App\Users\Domain\Auth;

use App\Users\Domain\ValueObject\UserGoogleAuthCode;
use App\Users\Infrastructure\Google\GoogleUserDTO;

interface GoogleOAuthClientInterface
{
    public function fetchUserData(UserGoogleAuthCode $token): GoogleUserDTO;
}
