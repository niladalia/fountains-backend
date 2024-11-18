<?php

namespace App\Comments\Application\Find;

use App\Comments\Domain\CommentRepository;
use App\Comments\Domain\Comments;
use App\Comments\Domain\ValueObject\CommentFountainId;
use App\Comments\Domain\ValueObject\CommentUserId;
use App\Users\Domain\ValueObject\UserId;

class CommentsFinderByEntity
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function findByUserId(string $userId): ?array
    {
        $comments =  $this->commentRepository->findByUserId(new CommentUserId($userId));
        return $comments->toArray();
    }

    public function findByFountainId(string $fountainId): ?array
    {
        $comments =  $this->commentRepository->findByFountainId(new CommentFountainId($fountainId));
        return $comments->toArray();
    }

}
