<?php

namespace App\Fountains\Application\Find;

use App\Fountains\Domain\Exceptions\FountainNotFound;
use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\Fountains;
use App\Fountains\Domain\ValueObject\FountainId;

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