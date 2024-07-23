<?php

namespace App\Tests\Fountains\Application\Create;

use App\Fountains\Domain\FountainRepository;
use App\Tests\Fountains\FountainsUnitTestCase;

class FountainCreatorUnitTest extends FountainsUnitTestCase
{
    private FountainRepository $fountainRepository;
    public function setUp(): void
    {
        parent::setUp();

        $this->fountainRepository = $this->createMock(FountainRepository::class);

    }
}