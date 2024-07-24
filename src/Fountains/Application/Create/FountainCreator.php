<?php

namespace App\Fountains\Application\Create;

use App\Fountains\Application\Create\DTO\CreateFountainRequest;
use App\Fountains\Domain\FountainRepository;

class FountainCreator
{
    public function __construct(private FountainRepository $fountainRepository) { }

    public function __invoke(CreateFountainRequest $fountainRequest): void
    {
        $fountain = CreateFountainFactory::create($fountainRequest);

        $this->fountainRepository->save($fountain);
    }
}