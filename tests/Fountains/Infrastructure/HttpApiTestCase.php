<?php

namespace App\Tests\Fountains\Infrastructure;

use App\Authors\Infrastructure\Persistence\DoctrineAuthorRepository;
use App\Fountains\Application\Create\DTO\CreateFountainRequest;
use App\Fountains\Application\Create\DTO\FountainRequest;
use App\Fountains\Application\Create\FountainCreator;
use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Infrastructure\Persistence\Doctrine\Repository\DoctrineFountainRepository;
use App\Tests\Fountains\Application\Create\DTO\CreateFountainRequestMother;
use App\Tests\Shared\Infrastructure\Doctrine\PostgresTestDatabaseCleaner;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HttpApiTestCase extends WebTestCase
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

    protected function post(string $uri, array $data = [])
    {
        $this->client->request(
            'POST',
            $uri,
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            json_encode($data)
        );
    }

    protected function delete(string $uri)
    {
        $this->client->request(
            'DELETE',
            $uri,
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            ''
        );
    }

    protected function clearDatabase(): void
    {
        $cleaner = new PostgresTestDatabaseCleaner(
            $this->getContainer()->get(Connection::class)
        );
        $cleaner->__invoke();
    }

    /**
     * @param CreateFountainRequest $fountainRequest
     */
    protected function createFountain(Fountain $fountain): void
    {

        $fountainRepository = static::getContainer()->get(DoctrineFountainRepository::class);
        $fountainRepository->save($fountain);
       /* $fountainRepository = $this->createMock(FountainRepository::class);

        $fountainCreator = new FountainCreator($fountainRepository);

        $fountainCreator->__invoke($fountainRequest);
       */
    }

}