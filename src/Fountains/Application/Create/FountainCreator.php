<?php

namespace App\Fountains\Application\Create;

use App\Fountains\Domain\Fountain;
use App\Fountains\Domain\FountainRepository;
use App\Fountains\Domain\ValueObject\FountainAccesBottles;
use App\Fountains\Domain\ValueObject\FountainAccesPets;
use App\Fountains\Domain\ValueObject\FountainAccessWheelchair;
use App\Fountains\Domain\ValueObject\FountainDescription;
use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLegalWater;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainName;
use App\Fountains\Domain\ValueObject\FountainOperationalStatus;
use App\Fountains\Domain\ValueObject\FountainPicture;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Fountains\Domain\ValueObject\FountainProviderUpdatedAt;
use App\Fountains\Domain\ValueObject\FountainSafeWater;
use App\Fountains\Domain\ValueObject\FountainType;
use App\Fountains\Domain\ValueObject\FountainUserId;

class FountainCreator
{
    public function __construct(private FountainRepository $fountainRepository) { }

    public function __invoke(CreateFountainRequest $fountainRequest)
    {
        $this->fountainRepository->save($this->create($fountainRequest));
    }

    public function queue(CreateFountainRequest $fountainRequest): Fountain
    {
        $fountain = $this->create($fountainRequest);
        $this->fountainRepository->persist($fountain);
        return $fountain;
    }

    protected function create(CreateFountainRequest $fountainRequest): Fountain
    {
        /*
           We generate the UUID in the application service because since both POST and PUT controller can create new UUIDs,
           we wanted to have a centralized place for the generation of the uuid. Typically we would generate it in the Infrastructure layer
        */
        $id = FountainId::generate();

        $fountain = Fountain::create(
            $id,
            new FountainLat($fountainRequest->lat()),
            new FountainLong($fountainRequest->long()),
            new FountainName($fountainRequest->name()),
            FountainType::fromString($fountainRequest->type()),
            new FountainPicture($fountainRequest->picture()),
            new FountainDescription($fountainRequest->description()),
            new FountainOperationalStatus($fountainRequest->operational_status()),
            FountainSafeWater::fromString($fountainRequest->safe_water()),
            FountainLegalWater::fromString($fountainRequest->legal_water()),
            new FountainAccesBottles($fountainRequest->access_bottles()),
            new FountainAccesPets($fountainRequest->access_pets()),
            new FountainAccessWheelchair($fountainRequest->access_wheelchair()),
            new FountainProviderName($fountainRequest->provider_name()),
            new FountainProviderId($fountainRequest->provider_id()),
            new FountainUserId($fountainRequest->user_id()),
            new FountainProviderUpdatedAt($fountainRequest->provider_updated_at())
        );

        return $fountain;
    }
}