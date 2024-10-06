<?php

namespace App\Users\Application\Login\DTO;

use App\Users\Application\UserRequest;

class LoginUserRequest extends UserRequest
{
    public function __construct(
        string $email,
        string $password
    )
    {
        parent::__construct($email, $password);
    }
}