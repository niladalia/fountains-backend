<?php

namespace App\Tests\Fountains\Infrastructure\Controllers;

use App\Authors\Infrastructure\Persistence\DoctrineAuthorRepository;
use App\Providers\Domain\ProviderRepository;
use App\Tests\Fountains\Infrastructure\ApiTestCase;
use App\Tests\Fountains\Infrastructure\FountainHttpRequestFactory;
use App\Tests\Providers\Domain\ProviderMother;
use App\Tests\Providers\Domain\ProviderNameMother;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\DependencyInjection\Container;

class FountainPostControllerTest extends ApiTestCase
{

    public function testCreateFountainPost(){

        $client = $this->client;

        $data = (new FountainHttpRequestBuilder)
                    ->setUserRequest()
                    ->build();

        $this->sendRequest(
            $client,
            $data
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testCreateFountainWithProvider(){

        $client = $this->client;

        $providerName = ProviderNameMother::create("GeoMap");
        $provider = ProviderMother::create($providerName);

        $providerRep = $this->providersRepository();

        $providerRep->save($provider);

        $data = (new FountainHttpRequestBuilder)
            ->setProviderName($providerName->getValue())
            ->setProviderRequest()
            ->build();


        $this->sendRequest(
            $client,
            $data
        );


        $this->assertEquals(201, $client->getResponse()->getStatusCode());
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

    private function providersRepository(): ProviderRepository{
        return static::getContainer()->get(ProviderRepository::class);
    }
}