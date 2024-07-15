<?php

namespace App\Shared\Domain\Repository;

/**
 * Interface for a database repository that provides basic transaction management
 * and batch processing capabilities.
 */
interface DatabaseRepository
{
    /**
     * Starts a new database transaction.
     */
    public function startTransaction(): void;

    /**
     * Commits the current database transaction.
     */
    public function endTransaction(): void;

    /**
     * Rolls back the current database transaction.
     */
    public function rollback(): void;
    
    /**
     * Make an instance managed and persistent.
     * The object will be entered into the database when the apply method is called.
     *
     * @param object $object The object to persist.
     */
    public function persist(object $object): void;

    /**
     * Apply the changes to the database.
     */
    public function apply(): void;

    /**
     * Persist an object to the database.
     * This is a combination of persist and apply methods.
     *
     * @param object $object The object to persist to the database.
     */
    public function save(object $object): void;

    /**
     * Executes a callable function within a database transaction.
     * Starts a transaction, executes the callable, and commits the transaction.
     * Rolls back the transaction if an exception occurs.
     *
     * @param callable $f The function to execute within the transaction.
     */
    public function runInTransaction(callable $f): void;

    /**
     * Processes an array of items in batches, applying changes periodically.
     *
     * @param array $items The items to process.
     * @param callable $process The function to process each item.
     * @param int $batchSize The number of items to process before applying changes.
     */
    public function processInBatches(array $items, callable $process, int $batchSize = 100): void;
}