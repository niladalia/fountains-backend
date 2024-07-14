<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\Fountains;

class FountainsFinder
{
    private $fountainRepository;

    public function __construct(FountainRepository $fountainRepository)
    {
        $this->fountainRepository = $fountainRepository;
    }

    public function __invoke(): ?Fountains
    {
        return $this->fountainRepository->search();
    }
}