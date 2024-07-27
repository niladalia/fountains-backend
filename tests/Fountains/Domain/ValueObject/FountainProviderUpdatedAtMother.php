<?php

namespace App\Tests\Fountains\Domain\ValueObject;

use App\Fountains\Domain\ValueObject\FountainProviderUpdatedAt;
use Faker\Factory;
use DateTime;

class FountainProviderUpdatedAtMother
{
    public static function create( DateTime $value = null): FountainProviderUpdatedAt
    {
        $dateTimeValue = $value ?? new DateTime(Factory::create()->dateTime()->format(DateTime::ATOM));
        return new FountainProviderUpdatedAt($dateTimeValue);
    }
}