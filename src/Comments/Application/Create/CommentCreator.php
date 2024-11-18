<?php

namespace App\Comments\Application\Create;

use App\Comments\Application\Create\DTO\CommentCreatorRequest;
use App\Comments\Domain\Comment;
use App\Comments\Domain\CommentRepository;
use App\Comments\Domain\ValueObject\CommentContent;
use App\Comments\Domain\ValueObject\CommentFountainId;
use App\Comments\Domain\ValueObject\CommentId;
use App\Comments\Domain\ValueObject\CommentUserId;

class CommentCreator
{
    public function __construct(private CommentRepository $repository)
    {
    }

    public function __invoke(CommentCreatorRequest $request): void
    {
        $comment = Comment::create(
            new CommentId($request->commentId()),
            new CommentUserId($request->userId()),
            new CommentFountainId($request->fountainId()),
            new CommentContent($request->content())
        );
        $this->repository->save($comment);
    }
}
