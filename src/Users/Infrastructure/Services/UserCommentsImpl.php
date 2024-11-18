<?php

namespace App\Users\Infrastructure\Services;

use App\Comments\Application\Find\CommentsFinderByEntity;
use App\Comments\Domain\Comments;
use App\Users\Domain\ACL\UserCommentsACL;
use App\Users\Domain\ValueObject\UserId;

class UserCommentsImpl implements UserCommentsACL
{
    public function __construct(private CommentsFinderByEntity $commentFinder)
    {

    }

    public function getCommentsForUserId(UserId $userId): array
    {
        return $this->commentFinder->findByUserId($userId->getValue());
    }
}
