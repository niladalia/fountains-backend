<?php

namespace App\Tests\Fountains\Infrastructure\Controllers;

use App\Providers\Domain\ProviderRepository;
use App\Tests\Fountains\Infrastructure\ApiTestCase;
use App\Tests\Fountains\Infrastructure\Controllers\Create\FountainHttpRequestBuilder;
use App\Tests\Fountains\Infrastructure\HttpApiTestCase;
use App\Tests\Users\Domain\UserMother;
use App\Users\Domain\EventHandler\SendWelcomeEmailHandler;
use App\Users\Domain\UserRepository;
use App\Users\Infrastructure\Persistence\Doctrine\Repository\DoctrineUserRepository;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Tests\Providers\Domain\ProviderMother;
use App\Tests\Providers\Domain\ProviderNameMother;
use Symfony\Component\Messenger\MessageBusInterface;

class FountainPostControllerTest extends HttpApiTestCase
{
    private UserRepository $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->auth();
        $this->userRepository = static::getContainer()->get(DoctrineUserRepository::class);
    }

    public function testCreateFountainPost(){

        $client = $this->client;

        $user = UserMother::create();

        $this->userRepository->save($user);

        $request = (new FountainHttpRequestBuilder())
                    ->setUserRequest()
                    ->setUserId($user->id()->getValue())
                    ->build();

        $this->post(
            '/api/fountains',
            $request
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testCreateFountainWithProvider(){

        $client = $this->client;

        $providerName = ProviderNameMother::create("GeoMap");
        $provider = ProviderMother::create($providerName);

        $providerRep = $this->providersRepository();

        $providerRep->save($provider);

        $request = (new FountainHttpRequestBuilder())
            ->setProviderName($providerName->getValue())
            ->setProviderRequest()
            ->build();


        $this->post(
            '/api/fountains',
            $request
        );


        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    #[DataProvider('invalidLatitudesProvider')]
    public function testCreateFountainWithInvalidData($invalidLat){
        $client = $this->client;

        $user = UserMother::create();

        $this->userRepository->save($user);

        $request = (new FountainHttpRequestBuilder())
            ->setLat($invalidLat)
            ->setUserRequest()
            ->build();


        $this->post(
            '/api/fountains',
            $request
        );

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testCreateFountainWithMissingData(){
        $client = $this->client;

        $request = (new FountainHttpRequestBuilder())
            ->setUserRequest()
            ->build();

        $request['long'] = null;

        $this->post(
            '/api/fountains',
            $request
        );

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }


    public static function invalidLatitudesProvider(): array
    {
        return [
            ['abc'],
            [111.1],
            ['1b2b1'],
            [-90.1]

        ];
    }

    private function providersRepository(): ProviderRepository{
        return static::getContainer()->get(ProviderRepository::class);
    }
}
