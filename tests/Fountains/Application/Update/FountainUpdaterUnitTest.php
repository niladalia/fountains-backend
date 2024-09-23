<?php

namespace App\Tests\Fountains\Application\Create;

use App\Fountains\Application\Find\FountainFinder;
use App\Fountains\Application\Update\FountainUpdater;
use App\Fountains\Domain\Exceptions\FountainNotFound;
use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Tests\Fountains\Application\Update\DTO\UpdateFountainRequestMother;
use App\Tests\Fountains\Domain\FountainMother;
use App\Tests\Fountains\Domain\ValueObject\FountainIdMother;
use App\Tests\Fountains\Domain\ValueObject\FountainNameMother;
use App\Tests\Fountains\FountainsUnitTestCase;

class FountainUpdaterUnitTest extends FountainsUnitTestCase
{
    private FountainUpdater $fountainUpdater;
    private FountainFinder $finder;
    private FountainId $uuid;
    private Fountain $fountain;

    public function setUp(): void
    {
        parent::setUp();
        $this->finder =  $this->createMock(FountainFinder::class);
        $this->fountainUpdater = new FountainUpdater($this->finder);
        // We create a fountain so we can use it as the one we are going to be updating during the tests
        $this->uuid = FountainIdMother::create();
        $this->fountain = FountainMother::create($this->uuid);

    }

    public function test_it_updates_a_fountain(): void
    {
        $updated_name = FountainNameMother::create("NEW NAME");

        $this->assertNotEquals($updated_name->getValue(), $this->fountain->name()->getValue());

        $updateFountainRequest = UpdateFountainRequestMother::create(
            $this->fountain->id()->getValue(),
            $this->fountain->lat()->getValue(),
            $this->fountain->long()->getValue(),
            $updated_name->getValue()
        );

        $this->finder->expects(self::exactly(1))
            ->method('__invoke')
            ->with($this->uuid->getValue())
            ->willReturn($this->fountain);

        $this->fountainUpdater->__invoke($updateFountainRequest);

        $this->assertEquals($updated_name->getValue(), $this->fountain->name()->getValue());
    }

    public function test_it_fails_to_update_when_id_does_not_exist(): void
    {
        // Setup
        $nonExistentId = FountainIdMother::create();
        $updateFountainRequest = UpdateFountainRequestMother::create(
            $nonExistentId->getValue()
        );
        $updated_name = $updateFountainRequest->name();

        // Mock FountainFinder to throw FountainNotFound when the non-existent ID is searched
        $this->finder->expects(self::exactly(1))
            ->method('__invoke')
            ->with($nonExistentId)
            ->willThrowException(new FountainNotFound());

        // Assert that the exception is expected
        $this->expectException(FountainNotFound::class);
        // Assert name is not equals
        $this->assertNotEquals($updated_name, $this->fountain->name()->getValue());
        // Execution
        $this->fountainUpdater->__invoke($updateFountainRequest);
    }
}