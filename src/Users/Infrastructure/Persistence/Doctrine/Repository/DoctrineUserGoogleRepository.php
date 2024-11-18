<?php

namespace App\Users\Infrastructure\Persistence\Doctrine\Repository;

use App\Shared\Infrastructure\Persistence\Doctrine\Repository\DoctrineDatabaseRepository;
use App\Users\Domain\UserGoogleRepository;

class DoctrineUserGoogleRepository extends DoctrineDatabaseRepository implements UserGoogleRepository
{
    public function saveGoogleAccount(string $userId, string $googleId): void
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql = "INSERT INTO user_google_id (user_id, google_id) VALUES (:userId, :googleId)";
        // Use executeStatement for executing an INSERT, UPDATE, or DELETE
        $this->getConnection()->executeStatement($sql, [
            'userId' => $userId,
            'googleId' => $googleId,
        ]);
    }

    public function findGoogleId(string $userId): ?string
    {
        $connection = $this->getConnection();
        $sql = "SELECT google_id FROM user_google_id WHERE user_id = :userId";
        // Use executeQuery for SELECT statements
        $stmt = $this->getConnection()->executeQuery($sql, [
            'userId' => $userId,
        ]);

        return $stmt->fetchOne() ?: null;
    }
}
