<?php

namespace App\Fountains\Infrastructure\Controllers;

use App\Fountains\Application\Delete\DeleteFountain;
use App\Fountains\Application\Delete\DTO\DeleteFountainRequest;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\PaginateConstraints;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

class FountainsDeleteController extends ApiController
{
    public function __invoke(string $id, DeleteFountain $fountainDeleter): Response
    {
        $fountainDeleter->__invoke(
            new DeleteFountainRequest($id)
        );

        return new JsonResponse('', Response::HTTP_NO_CONTENT);
    }


    protected function constraints(): Assert\Collection
    {
        return PaginateConstraints::constraintsAllowExtraFields();
    }
}
