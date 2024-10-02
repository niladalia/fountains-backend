<?php

namespace App\Tests\Fountains\Infrastructure\Controllers\Create;

use App\Providers\Domain\ProviderRepository;
use App\Tests\Fountains\Domain\ValueObject\FountainProviderIdMother;
use App\Tests\Fountains\Domain\ValueObject\FountainProviderUpdatedAtMother;
use App\Tests\Fountains\Infrastructure\HttpApiTestCase;
use App\Tests\Providers\Domain\ProviderMother;
use App\Tests\Providers\Domain\ProviderNameMother;
use App\Tests\Shared\Domain\DateTimeMother;
use PHPUnit\Framework\Attributes\DataProvider;
use DateTime;

class FountainPostControllerTest extends HttpApiTestCase
{

    public function testCreateFountainPost(){

        $client = $this->client;

        $request = (new FountainHttpRequestBuilder)
                    ->setUserRequest()
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

        $request = (new FountainHttpRequestBuilder)
            ->setProviderName($providerName->getValue())
            ->setProviderUrl($provider->url()->getValue())
            ->setProviderId(FountainProviderIdMother::generate()->getValue())
            ->setProviderUpdatedAt(DateTimeMother::generate()->format())
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

        $request = (new FountainHttpRequestBuilder)
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

        $request = (new FountainHttpRequestBuilder)
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