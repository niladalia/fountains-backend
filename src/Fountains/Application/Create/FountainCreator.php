<?php

namespace App\Fountains\Application\Create;

use App\Fountains\Application\Create\DTO\CreateFountainRequest;
use App\Fountains\Application\Create\Factory\CreateFountainFactory;
use App\Fountains\Domain\FountainRepository;
use App\Users\Application\Find\DTO\FindUserRequest;
use App\Users\Domain\Services\UserFinder;
use App\Users\Domain\ValueObject\UserId;

class FountainCreator
{
    public function __construct(
        private FountainRepository $fountainRepository,
        private UserFinder $finder
    )
    { }

    public function __invoke(CreateFountainRequest $fountainRequest): void
    {
        $userId = $fountainRequest->user_id();

        $user = $userId ? $this->finder->__invoke(UserId::fromString($userId)) : null;

        $fountain = CreateFountainFactory::create($fountainRequest, $user);

        $this->fountainRepository->save($fountain);
    }
}