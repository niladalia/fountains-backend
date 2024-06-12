<?php

namespace App\Products\Application\Create;


use App\Products\Domain\Product;
use App\Products\Domain\ProductRepository;
use App\Products\Domain\ValueObject\ProductId;
use App\Products\Domain\ValueObject\ProductName;

class ProductCreator
{
    public function __construct(private ProductRepository $productRepository)
    {

    }
    public function __invoke(CreateProductRequest $productRequest){

        $product = Product::create(
            new ProductId($productRequest->id()),
            new ProductName($productRequest->name())
        );

        $this->productRepository->save($product);
    }
}