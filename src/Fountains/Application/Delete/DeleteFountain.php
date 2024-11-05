<?php

namespace App\Fountains\Application\Delete;

use App\Fountains\Application\Delete\DTO\DeleteFountainRequest;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\Services\Find\FountainFinder;
use App\Fountains\Domain\ValueObject\FountainId;

class DeleteFountain
{

    public function __construct(
        private FountainRepository $fountainRepository,
        private FountainFinder $finder
    ) {}

    public function __invoke(DeleteFountainRequest $request): void
    {
        $fountain = $this->finder->__invoke(
            new FountainId( $request->id() )
        );

        $this->fountainRepository->delete($fountain);
    }
}
