<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony;

use App\Shared\Infrastructure\Symfony\Validation\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints as Assert;

abstract class ApiController extends AbstractController
{
    public function __construct() {}

    abstract protected function constraints(): Assert\Collection;

    protected function validateRequest(mixed $data, Assert\Collection $constraints): void
    {
        Validator::validate($data, $constraints);
    }
}
