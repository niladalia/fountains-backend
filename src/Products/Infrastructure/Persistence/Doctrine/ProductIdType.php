<?php

namespace App\Products\Infrastructure\Persistence\Doctrine;

use App\Products\Domain\ValueObject\ProductId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class ProductIdType extends GuidType
{
    public function getName(): string
    {
        return 'product_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?ProductId
    {
        return new ProductId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value->getValue();
    }
}
