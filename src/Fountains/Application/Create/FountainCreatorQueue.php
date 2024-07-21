<?php

namespace App\Fountains\Application\Create;

use App\Fountains\Application\Create\DTO\CreateFountainRequest;
use App\Fountains\Domain\Fountain;

class FountainCreatorQueue extends FountainCreator
{
    public function __invoke(CreateFountainRequest $fountainRequest): Fountain
    {
        $fountain = $this->create($fountainRequest);
        $this->fountainRepository->persist($fountain);
        return $fountain;
    }
}