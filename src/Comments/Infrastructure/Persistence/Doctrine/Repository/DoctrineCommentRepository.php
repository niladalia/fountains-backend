<?php

namespace App\Comments\Infrastructure\Persistence\Doctrine\Repository;


use App\Comments\Domain\Comment;
use App\Comments\Domain\CommentRepository;
use App\Comments\Domain\Comments;
use App\Comments\Domain\ValueObject\CommentFountainId;
use App\Comments\Domain\ValueObject\CommentUserId;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Users\Domain\ValueObject\UserId;
use App\Shared\Infrastructure\Persistence\Doctrine\Repository\DoctrineDatabaseRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineCommentRepository extends DoctrineDatabaseRepository implements CommentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function findByUserId(CommentUserId $userId)
    {
        $all_comments = $this->findBy(['user_id.value' => $userId->getValue()]);

        return new Comments($all_comments);
    }

    public function findByFountainId(CommentFountainId $fountainId)
    {
        $all_comments = $this->findBy(['fountain_id.value' => $fountainId->getValue()]);

        return new Comments($all_comments);
    }
}
