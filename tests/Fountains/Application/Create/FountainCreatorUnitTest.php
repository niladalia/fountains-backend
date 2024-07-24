<?php

namespace App\Tests\Fountains\Application\Create;

use App\Fountains\Application\Create\FountainCreator;
use App\Tests\Fountains\Application\Create\DTO\CreateFountainRequestMother;
use App\Tests\Fountains\Domain\FountainMother;
use App\Tests\Fountains\Domain\ValueObject\FountainDescriptionMother;
use App\Tests\Fountains\FountainsUnitTestCase;
use App\Tests\Shared\Domain\UuidMother;

class FountainCreatorUnitTest extends FountainsUnitTestCase
{
    private FountainCreator $bookCreator;

    public function setUp(): void
    {
        parent::setUp();
        $this->bookCreator = new FountainCreator($this->repository());

    }

    public function test_it_creates_a_fountain(): void
    {
        $uuid = UuidMother::create();

        $fountainRequest = CreateFountainRequestMother::create(
            $uuid
        );

        $fountain = FountainMother::fromRequest($fountainRequest);
        
        $this->shouldSave($fountain);

        $this->bookCreator->__invoke($fountainRequest);
    }
}