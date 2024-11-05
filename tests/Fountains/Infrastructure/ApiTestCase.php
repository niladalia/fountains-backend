<?php

namespace App\Tests\Fountains\Infrastructure;

use App\Tests\Shared\Infrastructure\Doctrine\MysqlTestDatabaseCleaner;
use App\Tests\Shared\Infrastructure\Doctrine\PostgresTestDatabaseCleaner;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTestCase extends WebTestCase
{
    protected $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->clearDatabase();

    }

    protected function tearDown(): void
    {
        parent::tearDown();
        static::ensureKernelShutdown();
        self::getClient(null);
        restore_exception_handler();
    }

    protected function clearDatabase(): void
    {
        $cleaner = new PostgresTestDatabaseCleaner(
            $this->getContainer()->get(Connection::class)
        );
        $cleaner->__invoke();
    }




}
