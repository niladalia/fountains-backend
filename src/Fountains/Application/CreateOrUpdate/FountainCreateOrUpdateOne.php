<?php

namespace App\Fountains\Application\CreateOrUpdate;

use App\Fountains\Application\CreateOrUpdate\DTO\CreateOrUpdateFountainRequest;

class FountainCreateOrUpdateOne extends FountainCreateOrUpdate
{
    public function __invoke(CreateOrUpdateFountainRequest $fountainRequest)
    {
        $this->queue($fountainRequest);
        
        $this->fountainRepository->apply();
    }
}