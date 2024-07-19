<?php

namespace App\Fountains\Infrastructure\Persistence\Doctrine\Repository;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\Fountains;
use App\Fountains\Domain\BoundingBox;
use App\Fountains\Domain\FountainsFilter;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\ArrayToFountainFactory;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Fountains\Infrastructure\Persistence\Doctrine\Filter\FindFountainsByFilter;
use App\Fountains\Infrastructure\Persistence\Doctrine\Filter\FindFountainsByBoundingBox;
use App\Shared\Infrastructure\Persistence\Doctrine\Repository\DoctrineDatabaseRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Statement;

class DoctrineFountainRepository extends DoctrineDatabaseRepository implements FountainRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fountain::class);
    }

    public function getAll(): Fountains
    {
        $fountains = $this->findAll();

        return new Fountains($fountains);
    }

    public function findById(FountainId $id): ?Fountain
    {
        return $this->find($id->getValue());
    }

    public function findByLocation(FountainLat $lat, FountainLong $long): ?Fountain
    {
        return $this->findOneBy([
            'lat.value' => $lat->getValue(),
            'long.value' => $long->getValue()
        ]);
    }

    public function findByProvider(FountainProviderName $providerName, FountainProviderId $provider_id): ?Fountain
    {
        return $this->findOneBy([
            'provider_name.value' => $providerName->getValue(),
            'provider_id.value' => $provider_id->getValue()
        ]);
    }

    public function findByFilter(FountainsFilter $filter): Fountains
    {
        $findFountainsByFilter = new FindFountainsByFilter($this->getConnection());

        return $this->executeFountainsQuery(
            $findFountainsByFilter->filter($filter)
        );
    }

    public function findByBoundingBox(BoundingBox $boundingBox): Fountains
    {
        $findFountainsByBoundingBox = new FindFountainsByBoundingBox($this->getConnection());

        return $this->executeFountainsQuery(
            $findFountainsByBoundingBox->filterByBoundingBox($boundingBox)
        );
    }

    private function executeFountainsQuery(Statement $queryStatement): Fountains
    {
        $fountainsArray = $queryStatement->executeQuery()->fetchAllAssociative();

        $fountains = array_map(ArrayToFountainFactory::getInstance(), $fountainsArray);

        return new Fountains($fountains);
    }

}
