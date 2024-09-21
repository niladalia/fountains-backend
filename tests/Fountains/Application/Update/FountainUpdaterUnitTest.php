<?php

namespace App\Tests\Fountains\Application\Create;

use App\Fountains\Application\Create\FountainCreator;
use App\Fountains\Application\Find\FountainFinder;
use App\Fountains\Application\Update\FountainUpdater;
use App\Tests\Fountains\Domain\FountainMother;
use App\Tests\Fountains\FountainsUnitTestCase;
use App\Tests\Shared\Domain\UuidMother;

class FountainUpdaterUnitTest extends FountainsUnitTestCase
{
    private FountainUpdater $fountainUpdater;
    private FountainFinder $finder;

    public function setUp(): void
    {
        parent::setUp();
        $this->finder =  $this->createMock(FountainFinder::class);
        $this->fountainUpdater = new FountainUpdater($this->finder, $this->repository());


    }

    public function test_it_updates_a_fountain(): void
    {
        $uuid = UuidMother::create();

        $updateFountainRequest = UpdateFountainRequest::create();
        $this->fountainUpdater($updateFountainRequest);
    }
}