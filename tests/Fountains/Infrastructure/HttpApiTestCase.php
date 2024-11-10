<?php

namespace App\Tests\Fountains\Infrastructure;

use App\Fountains\Application\Create\DTO\CreateFountainRequest;
use App\Fountains\Domain\Fountain;
use App\Fountains\Infrastructure\Persistence\Doctrine\Repository\DoctrineFountainRepository;
use App\Shared\Domain\Event\EventBus;
use App\Tests\Shared\Infrastructure\Doctrine\PostgresTestDatabaseCleaner;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HttpApiTestCase extends WebTestCase
{
    protected $client;
    public const DEFAULT_EMAIL = 'test@test.com';
    public const DEFAULT_PASS = 'TestPass';
    private ?string $token = null;

    protected $mockEventPublisher;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->mockEventPublisher = $this->createMock(EventBus::class);
        $this->getContainer()->set(EventBus::class, $this->mockEventPublisher);
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
            $this->headers(),
            json_encode($data),
        );
    }

    protected function delete(string $uri)
    {
        $this->client->request(
            'DELETE',
            $uri,
            [],
            [],
            $this->headers(),
            '',
        );
    }

    private function headers()
    {
        $headers = [
            'CONTENT_TYPE' => 'application/json',
        ];

        if ($this->token) {
            $headers['HTTP_Authorization'] = 'Bearer ' . $this->token;
        }

        return $headers;
    }

    protected function clearDatabase(): void
    {
        $cleaner = new PostgresTestDatabaseCleaner(
            $this->getContainer()->get(Connection::class),
        );
        $cleaner->__invoke();
    }

    /**
     * @param CreateFountainRequest $fountainRequest
     */
    protected function createFountain(Fountain $fountain): void
    {
        $this->repository(DoctrineFountainRepository::class)->save($fountain);
    }

    protected function auth(string $username = self::DEFAULT_EMAIL, string $password = self::DEFAULT_PASS): void
    {
        $this->post('/api/auth/register', [
            'email' => $username ?: self::DEFAULT_EMAIL,
            'password' => $password ?: self::DEFAULT_PASS,
            'name' => "name",
        ]);

        $this->post('/api/auth/login', [
            'email' => $username ?: self::DEFAULT_EMAIL,
            'password' => $password ?: self::DEFAULT_PASS,
        ]);

        /** @var string $content */
        $content = $this->client->getResponse()->getContent();

        $response = \json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        $this->token = $response['token'];
    }

    protected function repository(string $class)
    {
        return static::getContainer()->get($class);
    }
}
