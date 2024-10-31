<?php

namespace App\Tests\Fountains\Application\Find;

use App\Fountains\Application\Find\FountainFinder;
<<<<<<< HEAD
use App\Fountains\Domain\Exceptions\FountainNotFound;
use App\Fountains\Domain\Services\FountainFinder as DomainFinder;
use App\Tests\Fountains\Application\Find\DTO\FountainFinderRequestMother;
=======
>>>>>>> master
use App\Tests\Fountains\Domain\FountainMother;
use App\Tests\Fountains\Domain\ValueObject\FountainIdMother;
use App\Tests\Fountains\FountainsUnitTestCase;

class FountainFinderTest extends FountainsUnitTestCase
{
<<<<<<< HEAD
    private DomainFinder $domainFountainFinder;
=======
>>>>>>> master
    private FountainFinder $finder;

    public function setUp(): void
    {
<<<<<<< HEAD
        $this->domainFountainFinder = $this->createMock(DomainFinder::class);

        $this->finder = new FountainFinder($this->domainFountainFinder);
    }

    private function domainFinderShouldFind($id){
        return $this->domainFountainFinder
            ->expects($this->once())
            ->method('__invoke')
            ->with($id);
    }

    public function test_find_a_fountain_by_id(){
=======
        parent::setUp();
        $this->finder = new FountainFinder($this->repository());
    }

    public function test_find_a_fountain_by_id()
    {
>>>>>>> master
        $uuid = FountainIdMother::create();
        $fountain = FountainMother::create($uuid);

        $this->domainFinderShouldFind($uuid)->willReturn($fountain);

        $fountainFound = $this->finder->__invoke($uuid);

        $this->assertEquals($fountainFound->name(), $fountain->name());
        $this->assertEquals($fountainFound->id(), $fountain->id());
    }
<<<<<<< HEAD

    public function test_should_throw_exception_if_not_found()
    {
        $uuid = FountainIdMother::create();

        $fountainRequest = FountainFinderRequestMother::create($uuid->getValue());

        $this->domainFinderShouldFind($uuid)->willThrowException(new FountainNotFound("Fountain {$uuid->getValue()} not found"));

        $this->expectException(FountainNotFound::class);

        $this->finder->__invoke($fountainRequest);
    }

=======
>>>>>>> master
}