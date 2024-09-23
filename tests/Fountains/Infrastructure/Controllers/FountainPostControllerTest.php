<?php

namespace App\Tests\Fountains\Infrastructure\Controllers;

use App\Providers\Domain\ProviderRepository;
use App\Tests\Fountains\Infrastructure\ApiTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Tests\Providers\Domain\ProviderMother;
use App\Tests\Providers\Domain\ProviderNameMother;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class FountainPostControllerTest extends ApiTestCase
{

    public function testCreateFountainPost(){

        $client = $this->client;

        $request = (new FountainHttpRequestBuilder)
                    ->setUserRequest()
                    ->build();

        $this->sendRequest(
            $client,
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

        $request = (new FountainHttpRequestBuilder)
            ->setProviderName($providerName->getValue())
            ->setProviderRequest()
            ->build();


        $this->sendRequest(
            $client,
            $request
        );


        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    #[DataProvider('invalidLatitudesProvider')]
    public function testCreateFountainWithInvalidData($invalidLat){
        $client = $this->client;

        $request = (new FountainHttpRequestBuilder)
            ->setLat($invalidLat)
            ->setUserRequest()
            ->build();


        $this->sendRequest(
            $client,
            $request
        );

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testCreateFountainWithMissingData(){
        $client = $this->client;

        $request = (new FountainHttpRequestBuilder)
            ->setUserRequest()
            ->build();

        $request['long'] = null;

        $this->sendRequest(
            $client,
            $request
        );

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    private function sendRequest(KernelBrowser $client, array $data){
        $client->request(
            'POST',
            '/api/fountains',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            json_encode($data)
        );
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