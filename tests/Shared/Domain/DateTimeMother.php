<?php

namespace App\Tests\Shared\Domain;

use DateTime;
use Faker\Factory;

final class DateTimeMother
{
    private DateTime $dateTime;

    // Make the constructor private to enforce the use of the static generate method
    private function __construct(DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    // Static method to generate a DateTime and return an instance of DateTimeMother
    public static function generate(?string $date = null): self
    {
        // If no date is provided, use Faker to generate a DateTime in ATOM format
        $value = $date ?? Factory::create()->dateTime()->format(DateTime::ATOM);
        $dateTime = new DateTime($value);

        return new self($dateTime);
    }

    // Method to format the DateTime in the specified format (e.g., ATOM)
    public function format(string $format = DateTime::ATOM): string
    {
        return $this->dateTime->format($format);
    }
}
