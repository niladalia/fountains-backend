<?php

namespace App\Users\Domain;

use App\Users\Domain\ValueObject\UserEmail;

interface UniqueEmailSpecificationInterface
{
    public function checkUnique(UserEmail $email): bool;
}
