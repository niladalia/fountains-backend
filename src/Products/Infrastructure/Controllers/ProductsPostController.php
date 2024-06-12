<?php

namespace App\Products\Infrastructure\Controllers;

use App\Products\Application\Create\CreateProductRequest;
use App\Products\Application\Create\ProductCreator;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsPostController extends ApiController
{
    public function __invoke(Request $request,  ProductCreator $product_creator): Response
    {
        $request_data = json_decode($request->getContent(), true);

        $this->validateRequest($request_data, $this->constraints());

        $product_request = new CreateProductRequest(
            Uuid::generate()->getValue(),
            $request_data['name']
        );

        $product_creator->__invoke($product_request);

        return new Response('', Response::HTTP_CREATED);
    }


    private function constraints(): Assert\Collection
    {
        return new Assert\Collection(
            [
                'name' => [new Assert\NotBlank(), new Assert\Length(['min' => 3, 'max' => 255])]
            ]
        );
    }
}
