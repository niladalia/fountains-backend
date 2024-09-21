<?php

namespace App\Shared\Infrastructure\Persistence\Doctrine\Repository;

use App\Shared\Domain\Entity;
use App\Shared\Domain\Repository\DatabaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;

abstract class DoctrineDatabaseRepository extends ServiceEntityRepository implements DatabaseRepository
{
    protected function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function save(Entity $object): void
    {
        $this->persist($object);
        $this->apply();
    }

    public function persist(Entity $object): void
    {
        $this->getEntityManager()->persist($object);
    }

    public function delete(Entity $object): void
    {
        $this->getEntityManager()->remove($object);
    }

    public function apply(): void
    {
        $em = $this->getEntityManager();
        $em->flush();
        $em->clear();
    }

    public function startTransaction(): void
    {
        $this->getEntityManager()->beginTransaction();
    }

    public function endTransaction(): void
    {
        $this->getEntityManager()->commit();
    }

    public function rollback(): void
    {
        $this->getEntityManager()->rollback();
    }

    public function runInTransaction(callable $f): void
    {
        $this->getEntityManager()->wrapInTransaction($f);
    }

    public function processInBatches(array $items, callable $process, int $batchSize = 100, ?callable $onApply = null): void
    {
        $apply = function() use ($onApply) {
            $this->apply();

            if ($onApply !== null) {
                $onApply();
            }
        };

        $this->runInTransaction(function() use ($items, $process, $batchSize, $apply) {
            $count = 0;

            foreach ($items as $item) {
                $process($item);

                $count++;

                if ($count % $batchSize === 0) {
                    // Apply changes to the database periodically
                    $apply();
                }
            }

            $apply(); // Apply remaining changes
        });
    }

    protected function getConnection(): Connection
    {
        return $this->getEntityManager()->getConnection();
    }
}