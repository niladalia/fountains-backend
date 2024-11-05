<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Application\Find\DTO\FindFountainRequest;
use App\Fountains\Application\Find\DTO\FountainResponse;
use App\Fountains\Domain\Services\Find\FountainFinder as DomainFountainFinder;
use App\Fountains\Domain\ValueObject\FountainId;

class FountainFinder
{


    public function __construct(
        private DomainFountainFinder $finder,
        private FountainResponseFactory $responseConverter
    )
    { }

    public function __invoke(FindFountainRequest $findFountainRequest): FountainResponse
    {
        $fountain = $this->finder->__invoke(
            new FountainId($findFountainRequest->getId())
        );
        return  $this->responseConverter->__invoke($fountain);
    }
}
