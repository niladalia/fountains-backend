<?php

namespace App\Shared\Domain\Utils;

use App\Shared\Domain\Exceptions\InvalidArgument;
use DateTime;
use DateTimeZone;

const UTC = new DateTimeZone('UTC');

final class DateTimeUtils
{
    private function __construct() {}

    public static function now(): DateTime
    {
        return new DateTime('now', UTC);
    }

    public static function parseDateTime(?string $dateString): ?DateTime
    {
        if ($dateString === null) {
            return null;
        }

        try {
            return new DateTime($dateString);
        } catch (\Exception $e) {
            InvalidArgument::throw("Invalid date format for '$dateString'");
        }
    }
}
