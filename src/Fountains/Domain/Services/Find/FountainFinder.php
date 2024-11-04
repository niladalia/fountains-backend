<?php

namespace App\Fountains\Domain\Services\Find;

use App\Fountains\Domain\Exceptions\FountainNotFound;
use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\ValueObject\FountainId;

class FountainFinder
{
    private $fountainRepository;

    public function __construct(FountainRepository $fountainRepository)
    {
        $this->fountainRepository = $fountainRepository;
    }

    public function __invoke(FountainId $id): Fountain
    {

        $fountain = $this->fountainRepository->findById($id);

        if (!$fountain) {
            FountainNotFound::throw($id->getValue());
        }

        return $fountain;
    }
}
