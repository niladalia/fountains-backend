<?php

namespace App\Providers\Application\Create;

use App\Providers\Domain\Provider;
use App\Providers\Domain\ProviderRepository;
use App\Providers\Domain\ValueObject\ProviderName;

class ProviderCreator
{

    public function __construct(private ProviderRepository $repository){ }

    public function __invoke(CreateProviderRequest $providerRequest): void
    {
        $provider = Provider::create(
            new ProviderName($providerRequest->name()
            )
        );

        $this->repository->save($provider);

    }
}