<?php

namespace App\Fountains\Domain;

interface FountainRepository
{
    public function save(Fountain $product): void;
}