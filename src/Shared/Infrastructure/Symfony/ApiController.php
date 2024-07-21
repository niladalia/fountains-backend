<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony;

use App\Shared\Infrastructure\Symfony\Validation\Validator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints as Assert;

use DateTime;

abstract class ApiController extends AbstractController
{
    public function __construct() {}

    protected abstract function constraints(): Assert\Collection;

    protected function validateRequest(mixed $data, Assert\Collection $constraints): void
    {
        Validator::validate($data, $constraints);
    }

    protected function parseDateTime(?string $dateString): ?DateTime
    {
        if ($dateString === null) {
            return null;
        }

        try {
            return new DateTime($dateString);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException("Invalid date format for '$dateString'");
        }
    }
}
