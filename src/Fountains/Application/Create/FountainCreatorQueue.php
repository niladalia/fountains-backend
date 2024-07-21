<?php

namespace App\Fountains\Application\Create;

use App\Fountains\Application\Create\DTO\CreateFountainRequest;

class FountainCreatorQueue extends FountainCreator
{
    public function __invoke(CreateFountainRequest $fountainRequest)
    {
        $fountain = $this->create($fountainRequest);
        $this->fountainRepository->persist($fountain);
        return $fountain;
    }
}