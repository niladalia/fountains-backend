<?php

namespace App\Fountains\Domain\ACL;

use App\Comments\Domain\Comments;
use App\Fountains\Domain\ValueObject\FountainId;

interface FountainCommentsACL
{
    public function getCommentsForFountainId(FountainId $fountainId): array;

}
