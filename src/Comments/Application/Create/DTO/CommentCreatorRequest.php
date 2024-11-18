<?php

namespace App\Comments\Application\Create\DTO;

final readonly class CommentCreatorRequest
{
    public function __construct(
        private string $commentId,
        private string $userId,
        private string $fountainId,
        private string $content
    )
    {
    }

    public function commentId(): string
    {
        return $this->commentId;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function fountainId(): string
    {
        return $this->fountainId;
    }

    public function content(): string
    {
        return $this->content;
    }
}
