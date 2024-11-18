<?php

namespace App\Users\Domain\ACL;

use App\Comments\Domain\Comments;
use App\Users\Domain\ValueObject\UserId;

interface UserCommentsACL
{
    public function getCommentsForUserId(UserId $userId): array;
}
