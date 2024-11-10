<?php

namespace App\Providers\Application\Create;

use App\Providers\Application\Create\DTO\CreateProviderRequest;
use App\Providers\Application\Create\DTO\CreateProviderResponse;
use App\Providers\Domain\Provider;
use App\Providers\Domain\ProviderRepository;
use App\Providers\Domain\Services\Find\ProviderFinder;
use App\Providers\Domain\ValueObject\ProviderName;
use App\Providers\Domain\ValueObject\ProviderUrl;

class ProviderCreator
{
    public function __construct(
        protected ProviderRepository $providerRepository,
        private ProviderFinder $finder,
    ) {}

    /*
     * This service is used exclusively by the POST /provider controller, which
     * is called by the provider's script. Since the script only needs to check
     * if a provider already exists, we return `false` if it does, rather than
     * throwing an exception.
     */
    public function __invoke(CreateProviderRequest $providerRequest): CreateProviderResponse
    {
        $existingProvider = $this->finder->__invoke(
            new ProviderName($providerRequest->name()),
        );

        if ($existingProvider) {
            return new CreateProviderResponse(false);
        }

        $provider = Provider::create(
            new ProviderName($providerRequest->name()),
            new ProviderUrl($providerRequest->url()),
        );

        $this->providerRepository->save($provider);

        return new CreateProviderResponse(true);
    }
}
