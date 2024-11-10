<?php

namespace App\Users\Application\Find;

use App\Users\Application\Find\DTO\FindUserRequest;
use App\Users\Application\Find\DTO\FindUserResponse;
use App\Users\Domain\Services\UserFinder as DomainUserFinder;
use App\Users\Domain\ValueObject\UserId;

class UserFinder
{
    public function __construct(private DomainUserFinder $userFinder) {}

    public function __invoke(FindUserRequest $request): FindUserResponse
    {
        $user = $this->userFinder->__invoke(new UserId($request->id()));

        return new FindUserResponse(
            $user->id()->getValue(),
            $user->email()->getValue(),
            $user->fountains()->toSmallArray(),
        );
    }
}
