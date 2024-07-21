<?php

namespace App\Fountains\Application\CreateOrUpdate;

class FountainCreateOrUpdateOne extends FountainCreateOrUpdate
{
    public function __invoke(CreateOrUpdateFountainRequest $fountainRequest)
    {
        $this->queue($fountainRequest);
        $this->fountainRepository->apply();
    }
}