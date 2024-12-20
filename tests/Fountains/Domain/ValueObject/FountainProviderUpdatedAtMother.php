<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainProviderUpdatedAt;
use DateTime;

class FountainProviderUpdatedAtMother
{
    public static function create(DateTime $value = null): FountainProviderUpdatedAt
    {

        return new FountainProviderUpdatedAt($value);
    }
}
