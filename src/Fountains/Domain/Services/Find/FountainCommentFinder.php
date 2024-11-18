<?php

namespace App\Fountains\Domain\Services\Find;

use App\Comments\Domain\CommentRepository;
use App\Comments\Domain\Comments;
use App\Fountains\Domain\ValueObject\FountainId;

class FountainCommentFinder
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function __invoke(FountainId $fountainId): Comments
    {
        return $this->commentRepository->findByFountainId($fountainId);
    }
}
