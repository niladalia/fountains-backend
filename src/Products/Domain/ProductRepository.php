<?php

namespace App\Products\Domain;

interface ProductRepository
{
    public function save(Product $product): void;
}