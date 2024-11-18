<?php

namespace App\Users\Application\Find;

use App\Users\Application\Find\DTO\FindUserRequest;
use App\Users\Application\Find\DTO\FindUserResponse;
use App\Users\Domain\ACL\UserCommentsACL;
use App\Users\Domain\Services\UserFinder as DomainUserFinder;
use App\Users\Domain\ValueObject\UserId;

class UserFinder
{
    public function __construct(
        private DomainUserFinder $userFinder,
        private UserCommentsACL $userCommentsACL
    ) {}

    public function __invoke(FindUserRequest $request): FindUserResponse
    {
        $userId = new UserId($request->id());

        $user = $this->userFinder->__invoke($userId);
        $commentsArray = $this->userCommentsACL->getCommentsForUserId($userId);

        return new FindUserResponse(
            $user->id()->getValue(),
            $user->email()->getValue(),
            $user->fountains()->toSmallArray(),
            $commentsArray
        );
    }
}
