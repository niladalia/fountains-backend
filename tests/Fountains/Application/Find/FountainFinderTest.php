<?php

namespace App\Tests\Fountains\Application\Find;

use App\Fountains\Application\Find\FountainFinder;
use App\Tests\Fountains\Domain\FountainMother;
use App\Tests\Fountains\Domain\ValueObject\FountainIdMother;
use App\Tests\Fountains\FountainsUnitTestCase;

class FountainFinderTest extends FountainsUnitTestCase
{
    private FountainFinder $finder;

    public function setUp(): void
    {
        parent::setUp();
        $this->finder = new FountainFinder($this->repository());
    }

    public function test_find_a_fountain_by_id(){
        $uuid = FountainIdMother::create();

        $uuid = FountainIdMother::create($uuid->getValue());
        $fountain = FountainMother::create($uuid);

        $this->shouldFind($fountain, $uuid);

        $fountainFound = $this->finder->__invoke($uuid);

        $this->assertEquals($fountainFound->name(), $fountain->name());
        $this->assertEquals($fountainFound->id(), $fountain->id());
    }
}