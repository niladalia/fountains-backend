<?php

namespace App\Tests\Users\Domain;

use App\Users\Domain\User;
use App\Users\Domain\ValueObject\UserEmail;
use App\Users\Domain\ValueObject\UserId;
use App\Users\Domain\ValueObject\UserPassword;
use App\Users\Infrastructure\Persistence\Doctrine\DoctrineUniqueEmailSpecification;

class UserMother
{
    public static function create(
        ?UserId $id = null,
        ?UserEmail $email = null,
        ?UserPassword $password = null
    )
    {
        return new User(
            $id ?? UserId::generate(),
            $email ?? new UserEmail("change@change.com"),
            $password ?? new UserPassword("testchange")
        );

    }
}