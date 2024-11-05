<?php

namespace App\Tests\Fountains\Application\Delete;

use App\Fountains\Domain\Services\Find\FountainFinder;
use App\Fountains\Application\Delete\DeleteFountain;
use App\Fountains\Application\Delete\DTO\DeleteFountainRequest;
use App\Fountains\Domain\Fountain;
use App\Tests\Fountains\Domain\FountainMother;
use App\Tests\Fountains\Domain\ValueObject\FountainIdMother;
use App\Tests\Fountains\FountainsUnitTestCase;

class DeleteFountainTest extends FountainsUnitTestCase
{
    private DeleteFountain $deleter;
    private FountainFinder $finder;

    public function setUp(): void
    {
        parent::setUp();
        $this->finder =  $this->createMock(FountainFinder::class);
        $this->deleter = new DeleteFountain($this->repository(), $this->finder);
    }

    public function testDeleteFountain(): void
    {
        $id = FountainIdMother::create();
        $fountain = FountainMother::create($id);
        $this->repository()->save($fountain);

        $this->finder->expects(self::exactly(1))
              ->method('__invoke')
              ->with($id)
              ->willReturn($fountain);

          $this->shouldDelete($fountain);

               $this->deleter->__invoke(
              new DeleteFountainRequest(
                  $id->getValue()
              )
          );

        $this->assertNull($this->repository()->findById($id));
    }



    protected function shouldDelete(Fountain $fountain): void
    {
        $this->repository()
            ->expects(self::once())
            ->method('delete')
            ->with($this->isSimilar($fountain, ['created_at','updated_at']));
    }
}
