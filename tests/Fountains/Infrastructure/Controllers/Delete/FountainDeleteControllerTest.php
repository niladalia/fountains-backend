<?php

namespace App\Tests\Fountains\Infrastructure\Controllers\Delete;

use App\Fountains\Domain\ValueObject\FountainId;
use App\Providers\Domain\ProviderRepository;
use App\Tests\Fountains\Application\Create\DTO\CreateFountainRequestMother;
use App\Tests\Fountains\Domain\FountainMother;
use App\Tests\Fountains\Domain\ValueObject\FountainIdMother;
use App\Tests\Fountains\Infrastructure\HttpApiTestCase;

class FountainDeleteControllerTest extends HttpApiTestCase
{    private FountainId $id;
    public function setUp(): void
    {
        parent::setUp();

        $this->id = FountainIdMother::create();

        $this->createFountain(
            FountainMother::create(
                $this->id
            )
        );

    }

    public function testDeleteFountain(){

        $id =  $this->id->getValue();

        $client = $this->client;

        $this->delete(
            "/api/$id/fountain"
        );

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }


    private function providersRepository(): ProviderRepository{
        return static::getContainer()->get(ProviderRepository::class);
    }
}