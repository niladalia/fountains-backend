<?php

namespace App\Fountains\Infrastructure\Services;

use App\Comments\Application\Find\CommentsFinderByEntity;
use App\Comments\Domain\Comments;
use App\Fountains\Domain\ACL\FountainCommentsACL;
use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\ValueObject\FountainId;

class FountainCommentsImpl implements FountainCommentsACL
{
    public function __construct(private CommentsFinderByEntity $commentFinder)
    {

    }

    public function getCommentsForFountainId(FountainId $fountainId): array
    {
        return $this->commentFinder->findByFountainId($fountainId->getValue());
    }
}
