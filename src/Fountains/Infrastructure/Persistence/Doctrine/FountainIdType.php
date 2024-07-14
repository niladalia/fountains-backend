<?php

namespace App\Fountains\Infrastructure\Persistence\Doctrine;

use App\Fountains\Domain\ValueObject\FountainId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class FountainIdType extends GuidType
{
    public function getName(): string
    {
        return 'fountain_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?FountainId
    {
        return new FountainId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value->getValue();
    }
}
