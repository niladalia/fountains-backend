<?php

namespace App\Users\Infrastructure\Google;

use App\Users\Domain\Auth\GoogleOAuthClientInterface;
use App\Users\Domain\ValueObject\UserGoogleAuthCode;
use Google_Client;
use Google_Service_Oauth2;

class GoogleOAuthClient implements GoogleOAuthClientInterface
{
    public function __construct(private Google_Client $googleClient)
    { }

    public function fetchUserData(UserGoogleAuthCode $authCode): GoogleUserDTO
    {


        $accessToken = $this->googleClient->fetchAccessTokenWithAuthCode($authCode->getValue());

        var_dump($accessToken);

        $this->googleClient->setAccessToken($accessToken);

        // Fetch the user's profile information using the Oauth2 service
        $oauth2 = new Google_Service_Oauth2($this->googleClient);
        $googleUser = $oauth2->userinfo->get();

        //var_dump($googleUser);
        // Map the Google user data to our domain-specific GoogleUserDTO
        return new GoogleUserDTO(
            $googleUser->getId(),
            $googleUser->getEmail(),
            $googleUser->getName()
        );
    }
}