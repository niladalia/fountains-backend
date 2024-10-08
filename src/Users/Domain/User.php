<?php

namespace App\Users\Domain;

use App\Fountains\Domain\Fountains;
use App\Shared\Domain\Entity;
use App\Users\Domain\ValueObject\UserEmail;
use App\Users\Domain\ValueObject\UserId;
use App\Users\Domain\ValueObject\UserPassword;
use App\Users\Infrastructure\Persistence\Doctrine\DoctrineUniqueEmailSpecification;

class User implements Entity
{
    private $fountains = [];

    public function __construct(
        private UserId $id,
        private UserEmail $email,
        private UserPassword $password
    ){
        $this->fountains = [];
    }

    public static function create(
        UserId $id,
        UserEmail $email,
        UserPassword $password,
        DoctrineUniqueEmailSpecification $uniqueEmailSpecification
    )
    {
        $uniqueEmailSpecification->checkUnique($email);

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

    public function hashedPassword(): UserPassword
    {
        return $this->password;
    }

    public function fountains(): Fountains
    {
        return new Fountains($this->fountains->toArray());
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id()->getValue(),
            "email" => $this->email()->getValue(),
            "fountains" => $this->fountains()->toSmallArray()
        ];
    }
}