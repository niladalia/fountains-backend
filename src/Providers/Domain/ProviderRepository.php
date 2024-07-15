<?php

namespace App\Providers\Domain;

interface ProviderRepository
{
    public function save(Provider $provider): void;
}