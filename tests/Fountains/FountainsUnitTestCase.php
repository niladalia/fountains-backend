<?php

namespace App\Tests\Fountains;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Tests\Shared\Infrastructure\IsSimilar;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FountainsUnitTestCase extends KernelTestCase
{
    private FountainRepository $fountainRepository;

    public function setUp(): void
    {
        $this->fountainRepository = $this->createMock(FountainRepository::class);   
    }

    protected function shouldSave(Fountain $fountain): void
    {
        $this->repository()
            ->expects(self::exactly(1))
            ->method('save')
            ->with($this->isSimilar($fountain, []));
    }

    protected function repository(): FountainRepository
    {
        return $this->fountainRepository;
    }


    protected function isSimilar($expectedObject, array $excludedAttributes): IsSimilar
    {
        return new IsSimilar($expectedObject, $excludedAttributes);
    }
}