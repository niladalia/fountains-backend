<?php

namespace App\Comments\Domain;

use App\Comments\Domain\ValueObject\CommentFountainId;
use App\Comments\Domain\ValueObject\CommentUserId;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Users\Domain\ValueObject\UserId;
use App\Shared\Domain\Repository\DatabaseRepository;

interface CommentRepository extends DatabaseRepository
{
    public function findByUserId(CommentUserId $userId);
    public function findByFountainId(CommentFountainId $fountainId);
}
