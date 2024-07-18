<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class Validator
{
    public static function validate(mixed $data, Assert\Collection $constraints): void
    {
        $validator = Validation::createValidator();
        
        $validationErrors = $validator->validate($data, $constraints);

        if ($validationErrors->count() == 0) {
            return;
        }

        $errorsArray = [];

        foreach ($validationErrors as $violation) {
            $errorsArray[] = $violation->getPropertyPath() . " : " . $violation->getMessage();
        }
        throw new HttpException(Response::HTTP_BAD_REQUEST, json_encode($errorsArray));
    }
}
