<?php

namespace App\Users\Domain;

use App\Shared\Domain\Entity;
use App\Users\Domain\ValueObject\UserEmail;
use App\Users\Domain\ValueObject\UserId;
use App\Users\Domain\ValueObject\UserPassword;

class User implements Entity
{
    public function __construct(
        private UserId $id,
        private UserEmail $email,
        private UserPassword $password
    ){ }

    public static function create(
        UserId $id,
        UserEmail $email,
        UserPassword $password
    )
    {
    return new self(
        $id,
        $email,
        $password
    );

    }
    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function toArray(): array
    {
        return [];
    }
}