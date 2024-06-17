<?php

namespace App\Providers\Domain;

use App\Providers\Domain\ValueObject\ProviderAccesBottles;
use App\Providers\Domain\ValueObject\ProviderAccesPets;
use App\Providers\Domain\ValueObject\ProviderAccessWheelchair;
use App\Providers\Domain\ValueObject\ProviderCreatedAt;
use App\Providers\Domain\ValueObject\ProviderDescription;
use App\Providers\Domain\ValueObject\ProviderId;
use App\Providers\Domain\ValueObject\ProviderLat;
use App\Providers\Domain\ValueObject\ProviderLong;
use App\Providers\Domain\ValueObject\ProviderName;
use App\Providers\Domain\ValueObject\ProviderOperationalStatus;
use App\Providers\Domain\ValueObject\ProviderPicture;
use App\Providers\Domain\ValueObject\ProviderProviderId;
use App\Providers\Domain\ValueObject\ProviderProviderName;
use App\Providers\Domain\ValueObject\ProviderSafeWater;
use App\Providers\Domain\ValueObject\ProviderType;
use App\Providers\Domain\ValueObject\ProviderUpdatedAt;
use App\Providers\Domain\ValueObject\ProviderUserId;

class Provider
{

    public function __construct(
        private ProviderId                 $id,
        private ?ProviderName              $name
    )
    {
    }


    public static function create(
        ProviderId                $id,
        ProviderName              $name
    ): self {
        $product = new self(
            $id,
            $name
        );

        return $product;
    }

    public function id(): ?ProviderId
    {
        return $this->id;
    }

    public function name(): ?ProviderName
    {
        return $this->name;
    }

    public function setName(?ProviderName $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->getId()->getValue(),
            "name" => $this->getName()->getValue()
        ];
    }

}
