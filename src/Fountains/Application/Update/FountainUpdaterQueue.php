<?php

namespace App\Fountains\Application\Update;

use App\Fountains\Application\Update\DTO\UpdateFountainRequest;
use App\Fountains\Domain\Fountain;

class FountainUpdaterQueue extends FountainUpdater
{
    public function __invoke(UpdateFountainRequest $fountainRequest, Fountain $fountain = null): Fountain
    {
        $fountain = $this->update($fountainRequest, $fountain);
        $this->fountainRepository->persist($fountain);
        return $fountain;
    }
}