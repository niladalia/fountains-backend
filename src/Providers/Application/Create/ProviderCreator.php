<?php

namespace App\Providers\Application\Create;

use App\Providers\Domain\Provider;
use App\Providers\Domain\ProviderRepository;
use App\Providers\Domain\ValueObject\ProviderName;

class ProviderCreator
{
    public function __construct(private ProviderRepository $providerRepository) { }

    public function __invoke(CreateProviderRequest $providerRequest): void
    {
        $this->createWithName(new ProviderName($providerRequest->name()));
    }

    public function createIfNotExists(CreateProviderRequest $providerRequest): bool
    {
        $providerName = new ProviderName($providerRequest->name());

        $provider = $this->providerRepository->findByName($providerName);

        if ($provider) {
            return false;
        }

        $this->createWithName($providerName);

        return true;
    }

    private function createWithName(ProviderName $providerName)
    {
        $provider = Provider::create($providerName);

        $this->providerRepository->save($provider);
    }
}