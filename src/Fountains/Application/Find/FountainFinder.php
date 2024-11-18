<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Application\Find\DTO\FindFountainRequest;
use App\Fountains\Application\Find\DTO\FountainResponse;
use App\Fountains\Domain\ACL\FountainCommentsACL;
use App\Fountains\Domain\Services\Find\FountainFinder as DomainFountainFinder;
use App\Fountains\Domain\ValueObject\FountainId;

class FountainFinder
{
    public function __construct(
        private DomainFountainFinder $finder,
        private FountainResponseFactory $responseConverter,
        private FountainCommentsACL $fountainCommentsACL
    ) {}

    public function __invoke(FindFountainRequest $findFountainRequest): FountainResponse
    {
        $fountainId = new FountainId($findFountainRequest->getId());
        $fountain = $this->finder->__invoke(
            $fountainId,
        );

        /*
            I decided to create an ACL to avoid coupling between Fountains and Comment, it may not be necesary,
            but also, i don't think is a bad choice.
        */

        $comments = $this->fountainCommentsACL->getCommentsForFountainId($fountainId);

        return  $this->responseConverter->__invoke($fountain, $comments);
    }
}
