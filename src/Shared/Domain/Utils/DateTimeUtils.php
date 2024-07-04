<?php

namespace App\Shared\Domain\Utils;

use DateTime;
use DateTimeZone;

const UTC = new DateTimeZone('UTC');

final class DateTimeUtils
{
    private function __construct() { }

    public static function now(): DateTime
    {
        return new DateTime('now', UTC);
    }
}
