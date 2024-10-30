<?php

namespace App\Users\Infrastructure\Persistence\Doctrine\Repository;

use App\Shared\Infrastructure\Persistence\Doctrine\Repository\DoctrineDatabaseRepository;
use App\Users\Domain\User;
use App\Users\Domain\UserRepository;
use App\Users\Domain\ValueObject\UserEmail;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineUserRepository extends DoctrineDatabaseRepository implements UserRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByEmail(UserEmail $email): ?User
    {
        return $this->findOneBy(['email.value' => $email->getValue()]);

    }
}