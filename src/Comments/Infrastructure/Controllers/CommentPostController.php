<?php

namespace App\Comments\Infrastructure\Controllers;

use App\Comments\Application\Create\CommentCreator;
use App\Comments\Application\Create\DTO\CommentCreatorRequest;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use App\Shared\Domain\Utils\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;

class CommentPostController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(string $id, UserInterface $user, Request $request, CommentCreator $creator): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        $this->validateRequest($requestData, $this->constraints());
        $creator->__invoke(
            new CommentCreatorRequest(
                Uuid::generate()->getValue(),
                $user->getUserIdentifier(),
                $id,
                $requestData['comment']
            ),
        );

        return new JsonResponse(
            204,
        );

    }

    protected function constraints(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'comment' => [new Assert\NotBlank(), new Assert\Length(['min' => 3, 'max' => 255])]
            ]
        );
    }
}
