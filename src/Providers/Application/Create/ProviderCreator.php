<?php

namespace App\Providers\Application\Create;

use App\Providers\Domain\Provider;
use App\Providers\Domain\ProviderRepository;
use App\Providers\Domain\ValueObject\ProviderName;
use App\Providers\Domain\ValueObject\ProviderUrl;

class ProviderCreator
{
    public function __construct(private ProviderRepository $providerRepository) { }

    public function __invoke(CreateProviderRequest $providerRequest): void
    {
        $this->createAndSave($providerRequest);
    }

    public function createIfNotExists(CreateProviderRequest $providerRequest): bool
    {
        $provider = $this->providerRepository->findByName(new ProviderName($providerRequest->name()));

        if ($provider) {
            return false;
        }

        $this->createAndSave($providerRequest);

        return true;
    }

    private function createAndSave(CreateProviderRequest $providerRequest): void
    {
        $provider = Provider::create(
            new ProviderName($providerRequest->name()),
            new ProviderUrl($providerRequest->url())
        );

        $this->providerRepository->save($provider);
    }
}