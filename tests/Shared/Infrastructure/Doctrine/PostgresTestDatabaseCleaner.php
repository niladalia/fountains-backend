<?php

namespace App\Tests\Shared\Infrastructure\Doctrine;

use Doctrine\DBAL\Connection;

class PostgresTestDatabaseCleaner
{
    public function __construct(private Connection $connection) {}

    public function __invoke(): void
    {
        $connection = $this->connection;
        $tables = $connection->createSchemaManager()->listTableNames();

        // Begin a transaction to ensure atomicity
        $connection->beginTransaction();

        try {
            foreach ($tables as $table) {
                // Disable triggers to bypass foreign key checks
                $connection->executeQuery(sprintf('ALTER TABLE %s DISABLE TRIGGER ALL;', $table));

                // Truncate tables with CASCADE to handle dependent tables
                $connection->executeQuery(sprintf('TRUNCATE TABLE %s CASCADE;', $table));

                // Re-enable triggers
                $connection->executeQuery(sprintf('ALTER TABLE %s ENABLE TRIGGER ALL;', $table));
            }

            // Commit the transaction
            $connection->commit();
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            $connection->rollBack();
            throw $e;
        }
    }
}
