<?php

namespace App\Fountains\Application\Update;

use App\Fountains\Application\Update\DTO\UpdateFountainRequest;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\Services\Find\FountainFinder;
use App\Fountains\Domain\ValueObject\FountainAccesBottles;
use App\Fountains\Domain\ValueObject\FountainAccesPets;
use App\Fountains\Domain\ValueObject\FountainAccess;
use App\Fountains\Domain\ValueObject\FountainAccessWheelchair;
use App\Fountains\Domain\ValueObject\FountainAddress;
use App\Fountains\Domain\ValueObject\FountainDescription;
use App\Fountains\Domain\ValueObject\FountainFee;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLegalWater;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainName;
use App\Fountains\Domain\ValueObject\FountainOperationalStatus;
use App\Fountains\Domain\ValueObject\FountainPicture;
use App\Fountains\Domain\ValueObject\FountainSafeWater;
use App\Fountains\Domain\ValueObject\FountainType;

class FountainUpdater
{
    public function __construct(
        private FountainFinder $fountainFinder,
        private FountainRepository $repository
    ) { }

    public function __invoke(UpdateFountainRequest $updateRequest)
    {
        $fountain = $this->fountainFinder->__invoke(
            new FountainId($updateRequest->id())
        );

        $fountain->update(
            new FountainLat($updateRequest->lat()),
            new FountainLong($updateRequest->long()),
            new FountainName($updateRequest->name()),
            $updateRequest->type() !== null ? FountainType::fromString($updateRequest->type()) : $fountain->type(),
            new FountainPicture($updateRequest->picture()),
            new FountainDescription($updateRequest->description()),
            new FountainOperationalStatus($updateRequest->operational_status()),
            $updateRequest->safe_water() !== null ? FountainSafeWater::fromString($updateRequest->safe_water()) : $fountain->safe_water(),
            $updateRequest->legal_water() !== null ? FountainLegalWater::fromString($updateRequest->legal_water()) : $fountain->legal_water(),
            new FountainAccesBottles($updateRequest->access_bottles()),
            new FountainAccesPets($updateRequest->access_pets()),
            new FountainAccessWheelchair($updateRequest->access_wheelchair()),
            $updateRequest->access() !== null ? FountainAccess::fromString($updateRequest->access()) : $fountain->access(),
            new FountainFee($updateRequest->fee()),
            new FountainAddress($updateRequest->address())
        );

        $this->repository->save($fountain);
    }
}
