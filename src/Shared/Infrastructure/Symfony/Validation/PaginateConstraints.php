<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

use Symfony\Component\Validator\Constraints as Assert;

class PaginateConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'limit' => new Assert\Optional([
                new Assert\Type('digit'),
                new Assert\Range(['min' => 0])
            ]),
            'offset' => new Assert\Optional([
                new Assert\Type('digit'),
                new Assert\Range(['min' => 0])
            ])
        ];
    }
}
