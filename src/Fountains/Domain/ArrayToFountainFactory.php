<?php

namespace App\Fountains\Domain;

use App\Fountains\Domain\ValueObject\FountainAccesBottles;
use App\Fountains\Domain\ValueObject\FountainAccesPets;
use App\Fountains\Domain\ValueObject\FountainAccessWheelchair;
use App\Fountains\Domain\ValueObject\FountainCreatedAt;
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
use App\Fountains\Domain\ValueObject\FountainUpdatedAt;
use App\Fountains\Domain\ValueObject\FountainUserId;

use DateTime;

final class ArrayToFountainFactory
{
    private static ArrayToFountainFactory $instance;

    private function __construct() { }

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
            new FountainProviderName($data['provider_name']),
            new FountainProviderId($data['provider_id']),
            new FountainUserId($data['user_id']),
            new FountainProviderUpdatedAt(new DateTime($data['provider_updated_at'])),
            new FountainCreatedAt(new DateTime($data['created_at'])),
            new FountainUpdatedAt(new DateTime($data['updated_at'])),
        );
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ArrayToFountainFactory();
        }
        return self::$instance;
    }
}