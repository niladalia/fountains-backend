<?php

namespace App\Tests\Fountains\Application\Create;

use App\Fountains\Application\Create\FountainCreator;
use App\Shared\Domain\Event\EventBus;
use App\Tests\Fountains\Application\Create\DTO\CreateFountainRequestMother;
use App\Tests\Fountains\Domain\Events\FountainCreatedDomainEventMother;
use App\Tests\Fountains\Domain\FountainMother;
use App\Tests\Fountains\FountainsUnitTestCase;
use App\Tests\Shared\Domain\UuidMother;
use App\Tests\src\Authors\Domain\AuthorMother;
use App\Tests\src\Authors\Domain\ValueObject\AuthorIdMother;
use App\Tests\Users\Domain\UserMother;
use App\Users\Application\Find\DTO\FindUserRequest;
use App\Users\Domain\Services\UserFinder;
use App\Users\Domain\ValueObject\UserId;

class FountainCreatorUnitTest extends FountainsUnitTestCase
{
    private FountainCreator $fountainCreator;
    private UserFinder $userFinder;
    public function setUp(): void
    {
        parent::setUp();

        $this->userFinder = $this->createMock(UserFinder::class);

        $this->fountainCreator = new FountainCreator($this->repository(), $this->userFinder,$this->eventBus());
    }

    public function test_it_creates_a_fountain(): void
    {
        $uuid = UuidMother::create();
        $user = UserMother::create(UserId::generate());
        $fountainRequest = CreateFountainRequestMother::create([
            'id' => $uuid,
            'user_id' => $user->id()->getValue(),
        ]);

        $fountain = FountainMother::fromRequest($fountainRequest);

        $domainEvent = FountainCreatedDomainEventMother::fromFountain($fountain);

        $this->userFinder->expects(self::exactly(1))
            ->method('__invoke')
            ->with(UserId::fromString($user->id()->getValue()))
            ->willReturn($user);

        $this->shouldSave($fountain);


        $this->shouldPublishDomainEvent($domainEvent);

        $this->fountainCreator->__invoke($fountainRequest);
    }
}
