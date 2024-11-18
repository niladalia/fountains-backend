<?php

namespace App\Comments\Domain;

use App\Comments\Domain\ValueObject\CommentContent;
use App\Comments\Domain\ValueObject\CommentFountainId;
use App\Comments\Domain\ValueObject\CommentId;
use App\Comments\Domain\ValueObject\CommentUserId;
use App\Comments\Domain\ValueObject\CommentCreatedAt;
use App\Comments\Domain\ValueObject\CommentUpdatedAt;
use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\Utils\DateTimeUtils;

class Comment extends AggregateRoot
{
    public function __construct(
        private CommentId $id,
        private CommentContent $content,
        private CommentUserId $user_id,
        private CommentFountainId $fountain_id,
        private CommentCreatedAt $created_at,
        private CommentUpdatedAt $updated_at
    )
    {
    }


    public static function create(
        CommentId $id,
        CommentUserId $user_id,
        CommentFountainId $fountain_id,
        CommentContent $content
    ): self
    {
        $now = DateTimeUtils::now();
        $created_at = new CommentCreatedAt($now);
        $updated_at = new CommentUpdatedAt($now);

        return new self($id, $content, $user_id, $fountain_id, $created_at, $updated_at);
    }
   public function id(): CommentId
    {
        return $this->id;
    }

    public function user_id(): CommentUserId
    {
        return $this->user_id;
    }

    public function fountain_id(): CommentFountainId
    {
        return $this->fountain_id;
    }

    public function content(): CommentContent
    {
        return $this->content;
    }

    public function updated_at(): CommentUpdatedAt
    {
        return $this->updated_at;
    }

    public function created_at(): CommentCreatedAt
    {
        return $this->created_at;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id()->getValue(),
            "comment" => $this->content()->getValue(),
            "fountain_id" => $this->fountain_id()->getValue(),
            "created_at" => $this->created_at()->formatISO(),
        ];
    }

}
