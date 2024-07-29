<?php

namespace App\Tests\Fountains\Application\Find;

use App\Fountains\Application\Create\DTO\FountainRequest;
use App\Fountains\Application\Find\FountainFinder;
use App\Tests\Fountains\Application\Find\DTO\FountainFinderRequestMother;
use App\Tests\Fountains\Domain\FountainMother;
use App\Tests\Fountains\Domain\ValueObject\FountainIdMother;
use App\Tests\Fountains\FountainsUnitTestCase;

class FountainFinderTest extends FountainsUnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->finder = new FountainFinder($this->repository());
    }

    public function test_find_a_fountain_by_id(){
        $uuid = FountainIdMother::create();

        $fountainRequest = FountainFinderRequestMother::create($uuid->getValue());
        $fountain = FountainMother::create($uuid);

        $this->shouldFind($fountain, $uuid);

        $fountainFound =$this->finder->__invoke($fountainRequest);

        $this->assertEquals($fountainFound->name(), $fountain->name());
        $this->assertEquals($fountainFound->id(), $fountain->id());
    }
}