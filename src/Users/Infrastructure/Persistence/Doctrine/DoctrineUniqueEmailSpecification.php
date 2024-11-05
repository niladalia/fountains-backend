<?php

namespace App\Users\Infrastructure\Persistence\Doctrine;

use App\Users\Domain\Exception\EmailAlreadyExistException;
use App\Users\Domain\UniqueEmailSpecificationInterface;
use App\Users\Domain\UserRepository;
use App\Users\Domain\ValueObject\UserEmail;

class DoctrineUniqueEmailSpecification implements UniqueEmailSpecificationInterface
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function checkUnique(UserEmail $email): bool
    {
        if ($this->repository->findByEmail($email)) {
            return EmailAlreadyExistException::throw($email);
        }
        return true;
    }
}