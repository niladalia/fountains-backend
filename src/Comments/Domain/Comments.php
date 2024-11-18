<?php

namespace App\Comments\Domain;

final class Comments
{
    /**
     * @var Comment[]
     */
    private $comments;

    /**
     * @param Comment[] $comments
     */
    public function __construct(array $comments)
    {
        $this->comments = $comments;
    }

    public function toArray(): array
    {
        return array_map(fn($comment) => $comment->toArray(), $this->comments);
    }
}
