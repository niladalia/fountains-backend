<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainId;
use App\Fountains\Domain\ValueObject\FountainLat;
use App\Fountains\Domain\ValueObject\FountainLong;
use App\Fountains\Domain\ValueObject\FountainName;
use App\Fountains\Domain\ValueObject\FountainType;
use App\Fountains\Domain\ValueObject\FountainDescription;
use App\Fountains\Domain\ValueObject\FountainPicture;
use App\Fountains\Domain\ValueObject\FountainOperationalStatus;
use App\Fountains\Domain\ValueObject\FountainSafeWater;
use App\Fountains\Domain\ValueObject\FountainLegalWater;
use App\Fountains\Domain\ValueObject\FountainAccesBottles;
use App\Fountains\Domain\ValueObject\FountainAccesPets;
use App\Fountains\Domain\ValueObject\FountainAccessWheelchair;
use App\Fountains\Domain\ValueObject\FountainAccess;
use App\Fountains\Domain\ValueObject\FountainFee;
use App\Fountains\Domain\ValueObject\FountainAddress;
use App\Fountains\Domain\ValueObject\FountainWebsite;
use App\Fountains\Domain\ValueObject\FountainProviderName;
use App\Fountains\Domain\ValueObject\FountainProviderId;
use App\Fountains\Domain\ValueObject\FountainProviderUrl;
use App\Fountains\Domain\ValueObject\FountainProviderUpdatedAt;
use App\Fountains\Domain\ValueObject\FountainUserId;
use App\Fountains\Domain\ValueObject\FountainCreatedAt;
use App\Fountains\Domain\ValueObject\FountainUpdatedAt;

use App\Shared\Domain\Utils\Uuid;
use DateTime;

class ArrayToFountainFactory
{

    public function __construct(private UserFinder $finder) { }

    public function __invoke(array $data): Fountain
    {
        return new Fountain(
            FountainId::fromString($data['id']),
            new FountainLat($data['lat']),
            new FountainLong($data['long']),
            new FountainName($data['name']),
            FountainType::fromString($data['type']),
            new FountainPicture($data['picture']),
            new FountainDescription($data['description']),
            new FountainOperationalStatus($data['operational_status']),
            FountainSafeWater::fromString($data['safe_water']),
            FountainLegalWater::fromString($data['legal_water']),
            new FountainAccesBottles($data['access_bottles']),
            new FountainAccesPets($data['access_pets']),
            new FountainAccessWheelchair($data['acces_wheelchair']),
            FountainAccess::fromString($data['access']),
            new FountainFee($data['fee']),
            new FountainAddress($data['address']),
            new FountainWebsite($data['website']),
            new FountainProviderName($data['provider_name']),
            new FountainProviderId($data['provider_id']),
            new FountainProviderUpdatedAt(new DateTime($data['provider_updated_at'])),
            new FountainProviderUrl($data['provider_url']),
            new FountainUserId($data['user_id'] ? Uuid::fromString($data['user_id']) : null),
            new FountainCreatedAt(new DateTime($data['created_at'])),
            new FountainUpdatedAt(new DateTime($data['updated_at'])),
        );
    }
}
